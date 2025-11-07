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
            // SQLite doesn't support IF ... THEN in triggers; use UPSERT (ON CONFLICT) with CURRENT_TIMESTAMP
            DB::unprepared("CREATE TRIGGER tr_update_stok_pembelian\n            AFTER INSERT ON detail_pembelian\n            FOR EACH ROW\n            BEGIN\n                INSERT INTO stok_gudang (ikan_id, gudang_id, jumlah_stok, created_at, updated_at)\n                VALUES (\n                    NEW.ikan_id,\n                    (SELECT gudang_id FROM transaksi_pembelian WHERE id = NEW.transaksi_pembelian_id),\n                    NEW.jumlah_terima,\n                    CURRENT_TIMESTAMP,\n                    CURRENT_TIMESTAMP\n                )\n                ON CONFLICT(ikan_id, gudang_id) DO UPDATE SET\n                    jumlah_stok = jumlah_stok + excluded.jumlah_stok,\n                    updated_at = CURRENT_TIMESTAMP;\n            END");
        } else {
            DB::unprepared('
        CREATE TRIGGER tr_update_stok_pembelian
        AFTER INSERT ON detail_pembelian
        FOR EACH ROW
        BEGIN
            IF EXISTS (
                SELECT 1 FROM stok_gudang
                WHERE ikan_id = NEW.ikan_id AND gudang_id = (
                    SELECT gudang_id FROM transaksi_pembelian WHERE id = NEW.transaksi_pembelian_id
                )
            ) THEN
                UPDATE stok_gudang
                SET jumlah_stok = jumlah_stok + NEW.jumlah_terima
                WHERE ikan_id = NEW.ikan_id AND gudang_id = (
                    SELECT gudang_id FROM transaksi_pembelian WHERE id = NEW.transaksi_pembelian_id
                );
            ELSE
                INSERT INTO stok_gudang (ikan_id, gudang_id, jumlah_stok, created_at, updated_at)
                VALUES (
                    NEW.ikan_id,
                    (SELECT gudang_id FROM transaksi_pembelian WHERE id = NEW.transaksi_pembelian_id),
                    NEW.jumlah_terima,
                    NOW(),
                    NOW()
                );
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
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_stok_pembelian');
    }
};
