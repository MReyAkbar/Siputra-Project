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
            CREATE TRIGGER tr_update_stok_pembelian
            AFTER INSERT ON detail_pembelian
            FOR EACH ROW
            BEGIN
                DECLARE target_gudang BIGINT;

                -- Ambil gudang tujuan dari transaksi pembelian
                SELECT gudang_id INTO target_gudang
                FROM transaksi_pembelian
                WHERE id = NEW.transaksi_pembelian_id;

                -- Jika stok sudah ada → tambah jumlahnya
                IF EXISTS (
                    SELECT 1 FROM stok_gudang
                    WHERE varian_id = NEW.varian_id AND gudang_id = target_gudang
                ) THEN
                    UPDATE stok_gudang
                    SET jumlah_stok = jumlah_stok + NEW.jumlah_terima
                    WHERE varian_id = NEW.varian_id AND gudang_id = target_gudang;

                -- Jika stok belum ada → buat stok awal
                ELSE
                    INSERT INTO stok_gudang (varian_id, gudang_id, jumlah_stok, created_at, updated_at)
                    VALUES (NEW.varian_id, target_gudang, NEW.jumlah_terima, NOW(), NOW());
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_stok_pembelian');
    }
};
