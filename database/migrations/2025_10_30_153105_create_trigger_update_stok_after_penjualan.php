<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            // SQLite doesn't support DECLARE/SELECT ... INTO/SIGNAL. Use RAISE(ABORT, ...) and inline subqueries.
            DB::unprepared("CREATE TRIGGER tr_update_stok_penjualan\n            BEFORE INSERT ON detail_penjualan\n            FOR EACH ROW\n            BEGIN\n                SELECT CASE WHEN (SELECT COALESCE(jumlah_stok, 0) FROM stok_gudang WHERE ikan_id = NEW.ikan_id AND gudang_id = (SELECT gudang_id FROM transaksi_penjualan WHERE id = NEW.transaksi_penjualan_id)) < NEW.jumlah THEN RAISE(ABORT, 'Stok tidak mencukupi di gudang ini!') END;\n\n                UPDATE stok_gudang\n                SET jumlah_stok = jumlah_stok - NEW.jumlah\n                WHERE ikan_id = NEW.ikan_id AND gudang_id = (SELECT gudang_id FROM transaksi_penjualan WHERE id = NEW.transaksi_penjualan_id);\n            END");
        } else {
            DB::unprepared('
        CREATE TRIGGER tr_update_stok_penjualan
        BEFORE INSERT ON detail_penjualan
        FOR EACH ROW
        BEGIN
            DECLARE current_stok INT;
            DECLARE target_gudang BIGINT;

            SELECT gudang_id INTO target_gudang
            FROM transaksi_penjualan
            WHERE id = NEW.transaksi_penjualan_id;

            SELECT jumlah_stok INTO current_stok
            FROM stok_gudang
            WHERE ikan_id = NEW.ikan_id AND gudang_id = target_gudang;

            IF current_stok < NEW.jumlah THEN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Stok tidak mencukupi di gudang ini!";
            ELSE
                UPDATE stok_gudang
                SET jumlah_stok = jumlah_stok - NEW.jumlah
                WHERE ikan_id = NEW.ikan_id AND gudang_id = target_gudang;
            END IF;
        END
        ');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_stok_penjualan');
    }
};
