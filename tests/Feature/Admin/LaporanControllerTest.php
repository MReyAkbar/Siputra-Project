<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ikan;
use App\Models\Gudang;
use App\Models\KategoriIkan;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\TransaksiPembelian;
use App\Models\DetailPembelian;
use App\Models\TransaksiPenjualan;
use App\Models\DetailPenjualan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class LaporanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $manager;
    protected $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->manager = User::factory()->create(['role' => 'manager']);
        $this->customer = User::factory()->create(['role' => 'customer']);
    }

    // ==================== AUTHORIZATION TESTS ====================

    /**
     * Test: Admin bisa mengakses laporan harian
     */
    public function test_admin_bisa_mengakses_laporan_harian()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.laporan.harian');
        $response->assertViewHas('data');
        $response->assertViewHas('tanggal');
    }

    /**
     * Test: Admin bisa mengakses laporan mingguan
     */
    public function test_admin_bisa_mengakses_laporan_mingguan()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.mingguan'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.laporan.mingguan');
        $response->assertViewHas(['data', 'start', 'end']);
    }

    /**
     * Test: Admin bisa mengakses laporan bulanan
     */
    public function test_admin_bisa_mengakses_laporan_bulanan()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.laporan.bulanan');
        $response->assertViewHas(['data', 'month', 'year']);
    }

    /**
     * Test: Manager bisa mengakses laporan harian
     */
    public function test_manager_bisa_mengakses_laporan_harian()
    {
        $response = $this->actingAs($this->manager)
            ->get(route('laporan.harian'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.laporan.harian');
    }

    /**
     * Test: Manager bisa mengakses laporan mingguan
     */
    public function test_manager_bisa_mengakses_laporan_mingguan()
    {
        $response = $this->actingAs($this->manager)
            ->get(route('laporan.mingguan'));

        $response->assertStatus(200);
    }

    /**
     * Test: Manager bisa mengakses laporan bulanan
     */
    public function test_manager_bisa_mengakses_laporan_bulanan()
    {
        $response = $this->actingAs($this->manager)
            ->get(route('laporan.bulanan'));

        $response->assertStatus(200);
    }

    /**
     * Test: Customer tidak bisa mengakses laporan harian
     */
    public function test_customer_tidak_bisa_mengakses_laporan_harian()
    {
        $response = $this->actingAs($this->customer)
            ->get(route('laporan.harian'));

        $response->assertStatus(403);
    }

    /**
     * Test: Customer tidak bisa mengakses laporan mingguan
     */
    public function test_customer_tidak_bisa_mengakses_laporan_mingguan()
    {
        $response = $this->actingAs($this->customer)
            ->get(route('laporan.mingguan'));

        $response->assertStatus(403);
    }

    /**
     * Test: Customer tidak bisa mengakses laporan bulanan
     */
    public function test_customer_tidak_bisa_mengakses_laporan_bulanan()
    {
        $response = $this->actingAs($this->customer)
            ->get(route('laporan.bulanan'));

        $response->assertStatus(403);
    }

    // ==================== HARIAN REPORT TESTS ====================

    /**
     * Test: Laporan harian menampilkan data untuk tanggal spesifik
     */
    public function test_laporan_harian_menampilkan_data_untuk_tanggal_spesifik()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $today = Carbon::today();

        // Create pembelian for today
        $transaksiPembelian = TransaksiPembelian::factory()->create([
            'tanggal' => $today,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksiPembelian->id,
            'ikan_id' => $ikan->id,
            'jumlah_kirim' => 100,
            'jumlah_terima' => 95,
            'harga_beli' => 50000,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian', ['tanggal' => $today->format('Y-m-d')]));

        $response->assertStatus(200);
        $data = $response->viewData('data');
        
        $this->assertGreaterThan(0, $data->count());
        $this->assertEquals($ikan->nama, $data->first()['nama']);
    }

    /**
     * Test: Laporan harian menampilkan pesan saat tidak ada transaksi
     */
    public function test_laporan_harian_menampilkan_pesan_saat_tidak_ada_transaksi()
    {
        $futureDate = Carbon::now()->addYears(1);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian', ['tanggal' => $futureDate->format('Y-m-d')]));

        $response->assertStatus(200);
        $data = $response->viewData('data');
        $this->assertEquals(0, $data->count());
    }

    /**
     * Test: Laporan harian menampilkan pembelian dan penjualan
     */
    public function test_laporan_harian_menampilkan_pembelian_dan_penjualan()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $customerModel = Customer::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $today = Carbon::today();

        // Create pembelian
        $transaksiPembelian = TransaksiPembelian::factory()->create([
            'tanggal' => $today,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksiPembelian->id,
            'ikan_id' => $ikan->id,
            'jumlah_terima' => 100,
        ]);

        // Create penjualan
        $transaksiPenjualan = TransaksiPenjualan::factory()->create([
            'tanggal' => $today,
            'gudang_id' => $gudang->id,
            'customer_id' => $customerModel->id,
        ]);

        DetailPenjualan::factory()->create([
            'transaksi_penjualan_id' => $transaksiPenjualan->id,
            'ikan_id' => $ikan->id,
            'jumlah' => 50,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian', ['tanggal' => $today->format('Y-m-d')]));

        $data = $response->viewData('data');
        
        // Should have 2 records (1 pembelian + 1 penjualan)
        $this->assertEquals(2, $data->count());
        
        // Check types
        $types = $data->pluck('tipe')->toArray();
        $this->assertContains('Pembelian', $types);
        $this->assertContains('Penjualan', $types);
    }

    /**
     * Test: Laporan harian menampilkan data hari ini sebagai default
     */
    public function test_laporan_harian_menampilkan_data_hari_ini_sebagai_default()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian'));

        $response->assertStatus(200);
        $tanggal = $response->viewData('tanggal');
        $this->assertEquals(Carbon::today()->format('Y-m-d'), $tanggal);
    }

    // ==================== MINGGUAN REPORT TESTS ====================

    /**
     * Test: Laporan mingguan menampilkan data minggu ini sebagai default
     */
    public function test_laporan_mingguan_menampilkan_data_minggu_ini_sebagai_default()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.mingguan'));

        $response->assertStatus(200);
        
        $start = $response->viewData('start');
        $end = $response->viewData('end');
        
        // Verify it's current week
        $this->assertEquals(Carbon::now()->startOfWeek()->format('Y-m-d'), $start->format('Y-m-d'));
        $this->assertEquals(Carbon::now()->endOfWeek()->format('Y-m-d'), $end->format('Y-m-d'));
    }

    /**
     * Test: Laporan mingguan dapat di filter untuk minggu tertentu
     */
    public function test_laporan_mingguan_dapat_di_filter_untuk_minggu_tertentu()
    {
        // Use week format: 2024-W01
        $weekString = '2024-W01';

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.mingguan', ['week' => $weekString]));

        $response->assertStatus(200);
        
        $start = $response->viewData('start');
        
        // Should be first week of 2024
        $this->assertEquals(2024, $start->year);
        $this->assertEquals(1, $start->weekOfYear);
    }

    /**
     * Test: Laporan mingguan menghitung total dengan benar
     */
    public function test_laporan_mingguan_menghitung_total_dengan_benar()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $customerModel = Customer::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $thisWeekStart = Carbon::now()->startOfWeek();

        // Create pembelian
        $transaksiPembelian = TransaksiPembelian::factory()->create([
            'tanggal' => $thisWeekStart,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksiPembelian->id,
            'ikan_id' => $ikan->id,
            'jumlah_kirim' => 100,
            'jumlah_terima' => 100,
            'harga_beli' => 50000,
        ]);

        // Create penjualan
        $transaksiPenjualan = TransaksiPenjualan::factory()->create([
            'tanggal' => $thisWeekStart->copy()->addDay(),
            'gudang_id' => $gudang->id,
            'customer_id' => $customerModel->id,
        ]);

        DetailPenjualan::factory()->create([
            'transaksi_penjualan_id' => $transaksiPenjualan->id,
            'ikan_id' => $ikan->id,
            'jumlah' => 60,
            'harga_jual' => 75000,
            'subtotal' => 60 * 75000,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.mingguan'));

        $data = $response->viewData('data');
        
        $this->assertGreaterThan(0, $data->count());
        
        $firstRow = $data->first();
        $this->assertEquals(100, $firstRow['total_beli']);
        $this->assertEquals(60, $firstRow['total_jual']);
        $this->assertEquals(40, $firstRow['selisih']); // 100 - 60
    }

    /**
     * Test: Laporan mingguan menggabungkan ikan dengan benar
     */
    public function test_laporan_mingguan_menggabungkan_ikan_dengan_benar()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        
        $ikan1 = Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Tuna']);
        $ikan2 = Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Salmon']);

        $thisWeekStart = Carbon::now()->startOfWeek();

        // Create pembelian for both ikan
        foreach ([$ikan1, $ikan2] as $ikan) {
            $transaksi = TransaksiPembelian::factory()->create([
                'tanggal' => $thisWeekStart,
                'gudang_id' => $gudang->id,
                'supplier_id' => $supplier->id,
            ]);

            DetailPembelian::factory()->create([
                'transaksi_pembelian_id' => $transaksi->id,
                'ikan_id' => $ikan->id,
                'jumlah_terima' => 100,
                'harga_beli' => 50000,
            ]);
        }

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.mingguan'));

        $data = $response->viewData('data');
        
        // Should have 2 rows (one per ikan)
        $this->assertEquals(2, $data->count());
        
        $names = $data->pluck('nama')->toArray();
        $this->assertContains('Tuna', $names);
        $this->assertContains('Salmon', $names);
    }

    /**
     * Test: Laporan mingguan menangani data nol
     */
    public function test_laporan_mingguan_menangani_data_nol()
    {
        // Use future week
        $futureWeek = Carbon::now()->addYears(1)->format('Y') . '-W01';

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.mingguan', ['week' => $futureWeek]));

        $response->assertStatus(200);
        $data = $response->viewData('data');
        $this->assertEquals(0, $data->count());
    }

    // ==================== BULANAN REPORT TESTS ====================

    /**
     * Test: Laporan bulanan menampilkan bulan ini sebagai default
     */
    public function test_laporan_bulanan_menampilkan_bulan_ini_sebagai_default()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan'));

        $response->assertStatus(200);
        
        $month = $response->viewData('month');
        $year = $response->viewData('year');
        
        $this->assertEquals(now()->format('m'), $month);
        $this->assertEquals(now()->format('Y'), $year);
    }

    /**
     * Test: Laporan bulanan dapat di filter untuk bulan dan tahun tertentu
     */
    public function test_laporan_bulanan_dapat_di_filter_untuk_bulan_dan_tahun_tertentu()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan', ['month' => '06', 'year' => '2024']));

        $response->assertStatus(200);
        
        $month = $response->viewData('month');
        $year = $response->viewData('year');
        
        $this->assertEquals('06', $month);
        $this->assertEquals('2024', $year);
    }

    /**
     * Test: Laporan bulanan menggabungkan pembelian dan penjualan dengan benar
     */
    public function test_laporan_bulanan_menggabungkan_pembelian_dan_penjualan_dengan_benar()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $customerModel = Customer::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Tuna Test']);

        $thisMonth = Carbon::now()->startOfMonth();

        // Create pembelian
        $transaksiPembelian = TransaksiPembelian::factory()->create([
            'tanggal' => $thisMonth,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'created_at' => $thisMonth,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksiPembelian->id,
            'ikan_id' => $ikan->id,
            'jumlah_terima' => 200,
            'harga_beli' => 50000,
            'created_at' => $thisMonth,
        ]);

        // Create penjualan
        $transaksiPenjualan = TransaksiPenjualan::factory()->create([
            'tanggal' => $thisMonth->copy()->addDay(),
            'gudang_id' => $gudang->id,
            'customer_id' => $customerModel->id,
            'created_at' => $thisMonth->copy()->addDay(),
        ]);

        DetailPenjualan::factory()->create([
            'transaksi_penjualan_id' => $transaksiPenjualan->id,
            'ikan_id' => $ikan->id,
            'jumlah' => 150,
            'harga_jual' => 75000,
            'subtotal' => 150 * 75000,
            'created_at' => $thisMonth->copy()->addDay(),
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan'));

        $data = $response->viewData('data');
        
        // Find Tuna Test row
        $tunaRow = $data->firstWhere('ikan', 'Tuna Test');
        
        $this->assertNotNull($tunaRow);
        $this->assertEquals(200, $tunaRow['total_pembelian']);
        $this->assertEquals(150, $tunaRow['total_penjualan']);
    }

    /**
     * Test: Laporan bulanan bisa menampilkan only pembelian ikan
     */
    public function test_laporan_bulanan_bisa_menampilkan_only_pembelian_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Only Pembelian']);

        $thisMonth = Carbon::now()->startOfMonth();

        $transaksi = TransaksiPembelian::factory()->create([
            'tanggal' => $thisMonth,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'created_at' => $thisMonth,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksi->id,
            'ikan_id' => $ikan->id,
            'jumlah_terima' => 100,
            'harga_beli' => 50000,
            'created_at' => $thisMonth,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan'));

        $data = $response->viewData('data');
        $row = $data->firstWhere('ikan', 'Only Pembelian');
        
        $this->assertNotNull($row);
        $this->assertEquals(100, $row['total_pembelian']);
        $this->assertEquals(0, $row['total_penjualan']);
    }

    /**
     * Test: Laporan bulanan bisa menampilkan only penjualan ikan
     */
    public function test_laporan_bulanan_bisa_menampilkan_only_penjualan_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $customerModel = Customer::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Only Penjualan']);

        $thisMonth = Carbon::now()->startOfMonth();

        $transaksi = TransaksiPenjualan::factory()->create([
            'tanggal' => $thisMonth,
            'gudang_id' => $gudang->id,
            'customer_id' => $customerModel->id,
            'created_at' => $thisMonth,
        ]);

        DetailPenjualan::factory()->create([
            'transaksi_penjualan_id' => $transaksi->id,
            'ikan_id' => $ikan->id,
            'jumlah' => 80,
            'harga_jual' => 75000,
            'subtotal' => 80 * 75000,
            'created_at' => $thisMonth,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan'));

        $data = $response->viewData('data');
        $row = $data->firstWhere('ikan', 'Only Penjualan');
        
        $this->assertNotNull($row);
        $this->assertEquals(0, $row['total_pembelian']);
        $this->assertEquals(80, $row['total_penjualan']);
    }

    /**
     * Test: Laporan bulanan menangani data nol
     */
    public function test_laporan_bulanan_menangani_data_nol()
    {
        // Use future month
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan', ['month' => '12', 'year' => '2099']));

        $response->assertStatus(200);
        $data = $response->viewData('data');
        $this->assertEquals(0, $data->count());
    }

    /**
     * Test: Laporan bulanan menghitung nilai dengan benar
     */
    public function test_laporan_bulanan_menghitung_nilai_dengan_benar()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $thisMonth = Carbon::now()->startOfMonth();

        $transaksi = TransaksiPembelian::factory()->create([
            'tanggal' => $thisMonth,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'created_at' => $thisMonth,
        ]);

        // 100 kg @ Rp 50,000 = Rp 5,000,000
        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksi->id,
            'ikan_id' => $ikan->id,
            'jumlah_terima' => 100,
            'harga_beli' => 50000,
            'created_at' => $thisMonth,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.bulanan'));

        $data = $response->viewData('data');
        $row = $data->first();
        
        // Should calculate: 100 * 50000 = 5000000
        $this->assertEquals(5000000, $row['nilai_pembelian']);
    }

    // ==================== EDGE CASES & DATA INTEGRITY ====================

    /**
     * Test: Laporan menangani banyak transaksi di hari yang sama
     */
    public function test_laporan_menangani_banyak_transaksi_di_hari_yang_sama()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $today = Carbon::today();

        // Create 3 pembelian same day
        for ($i = 0; $i < 3; $i++) {
            $transaksi = TransaksiPembelian::factory()->create([
                'tanggal' => $today,
                'gudang_id' => $gudang->id,
                'supplier_id' => $supplier->id,
            ]);

            DetailPembelian::factory()->create([
                'transaksi_pembelian_id' => $transaksi->id,
                'ikan_id' => $ikan->id,
                'jumlah_terima' => 50,
                'harga_beli' => 50000,
            ]);
        }

        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian', ['tanggal' => $today->format('Y-m-d')]));

        $data = $response->viewData('data');
        
        // Should have 3 records
        $this->assertEquals(3, $data->count());
    }

    /**
     * Test: Laporan hanya menampilkan data untuk periode spesifik
     */
    public function test_laporan_hanya_menampilkan_data_untuk_periode_spesifik()
    {
        $kategori = KategoriIkan::factory()->create();
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Create transaction for yesterday
        $transaksi = TransaksiPembelian::factory()->create([
            'tanggal' => $yesterday,
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksi->id,
            'ikan_id' => $ikan->id,
            'jumlah_terima' => 100,
        ]);

        // Query for today (should be empty)
        $response = $this->actingAs($this->admin)
            ->get(route('laporan.harian', ['tanggal' => $today->format('Y-m-d')]));

        $data = $response->viewData('data');
        $this->assertEquals(0, $data->count());
    }
}