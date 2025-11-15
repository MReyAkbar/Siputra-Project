<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER tr_update_stok_penjualan
            BEFORE INSERT ON detail_penjualan
            FOR EACH ROW
            BEGIN
                DECLARE current_stok INT;
                DECLARE target_gudang BIGINT;

                -- Ambil gudang asal stok dari transaksi penjualan
                SELECT gudang_id INTO target_gudang
                FROM transaksi_penjualan
                WHERE id = NEW.transaksi_penjualan_id;

                -- Ambil stok varian di gudang tersebut
                SELECT jumlah_stok INTO current_stok
                FROM stok_gudang
                WHERE ikan_id = NEW.ikan_id AND gudang_id = target_gudang;

                -- Jika stok tidak ada atau kurang → tolak transaksi
                IF current_stok IS NULL OR current_stok < NEW.jumlah THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Stok tidak mencukupi untuk varian ikan ini di gudang yang dipilih.";
                ELSE
                    -- Kurangi stok
                    UPDATE stok_gudang
                    SET jumlah_stok = jumlah_stok - NEW.jumlah
                    WHERE ikan_id = NEW.ikan_id AND gudang_id = target_gudang;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_stok_penjualan');
    }
};
