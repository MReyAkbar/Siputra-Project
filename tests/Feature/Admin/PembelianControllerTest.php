<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\Ikan;
use App\Models\TransaksiPembelian;
use App\Models\DetailPembelian;
use App\Models\StokGudang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PembelianControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $manager;
    protected $customer;

    /**
     * Setup method runs before each test
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create users with different roles
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->manager = User::factory()->create(['role' => 'manager']);
        $this->customer = User::factory()->create(['role' => 'customer']);
    }

    /**
     * Test: Admin bisa mengakses halaman index pembelian
     */
    public function test_admin_bisa_mengakses_halaman_index_pembelian()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.pembelian.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.transaksi.pembelian.index');
        $response->assertViewHas('pembelian');
    }

    /**
     * Test: Manager bisa mengakses halaman index pembelian
     */
    public function test_Manager_bisa_mengakses_halaman_index_pembelian()
    {
        $response = $this->actingAs($this->manager)
            ->get(route('admin.pembelian.index'));

        $response->assertStatus(200);
    }

    /**
     * Test: Customer tidak bisa mengakses halaman index pembelian
     */
    public function test_customer_tidak_bisa_mengakses_halaman_index_pembelian()
    {
        $response = $this->actingAs($this->customer)
            ->get(route('admin.pembelian.index'));

        // Based on your RoleMiddleware, should be 403 or redirect
        $response->assertStatus(403);
    }

    /**
     * Test: Guest tidak bisa mengakses halaman index pembelian
     */
    public function test_guest_tidak_bisa_mengakses_halaman_index_pembelian()
    {
        $response = $this->get(route('admin.pembelian.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test: Admin bisa mengakses halaman input pembelian
     */
    public function test_admin_bisa_mengakses_halaman_input_pembelian()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.pembelian.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.transaksi.pembelian.create');
        $response->assertViewHas(['gudang', 'supplier', 'ikan']);
    }

    /**
     * Test: Admin bisa input data pembelian baru dengan sukses
     */
    public function test_admin_bisa_input_data_pembelian_baru_dengan_sukses()
    {
        // Create test data with sufficient warehouse capacity
        $gudang = Gudang::factory()->create([
            'kapasitas_kg' => 10000, // Large capacity to avoid capacity issues
        ]);
        $supplier = Supplier::factory()->create();
        $ikan1 = Ikan::factory()->create();
        $ikan2 = Ikan::factory()->create();

        // Prepare purchase data
        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan1->id, $ikan2->id],
            'jumlah_kirim' => [100, 150],
            'jumlah_terima' => [95, 145],
            'harga_beli' => [50000, 75000],
        ];

        // Submit the form
        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Assert redirect to index with success message
        $response->assertRedirect(route('admin.pembelian.index'));
        $response->assertSessionHas('success', 'Transaksi pembelian berhasil disimpan.');

        // Assert database has the transaksi_pembelian record
        $this->assertDatabaseHas('transaksi_pembelian', [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'admin_id' => $this->admin->id,
        ]);

        // Assert database has detail_pembelian records
        $this->assertDatabaseHas('detail_pembelian', [
            'ikan_id' => $ikan1->id,
            'jumlah_kirim' => 100,
            'jumlah_terima' => 95,
            'harga_beli' => 50000,
        ]);

        $this->assertDatabaseHas('detail_pembelian', [
            'ikan_id' => $ikan2->id,
            'jumlah_kirim' => 150,
            'jumlah_terima' => 145,
            'harga_beli' => 75000,
        ]);

        // Assert stock was updated (column name: jumlah_stok)
        $this->assertDatabaseHas('stok_gudang', [
            'gudang_id' => $gudang->id,
            'ikan_id' => $ikan1->id,
            'jumlah_stok' => 95, // Should equal jumlah_terima
        ]);

        $this->assertDatabaseHas('stok_gudang', [
            'gudang_id' => $gudang->id,
            'ikan_id' => $ikan2->id,
            'jumlah_stok' => 145,
        ]);
    }

    /**
     * Test: Validasi gagal saat tidak ada gudang_id 
     */
    public function test_validasi_gagal_saat_tidak_ada_gudang_id()
    {
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        $purchaseData = [
            // 'gudang_id' => missing
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $response->assertSessionHasErrors('gudang_id');
    }

    /**
     * Test: Validasi gagal saat tidak ada supplier_id
     */
    public function test_validasi_gagal_saat_tidak_ada_supplier_id()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $ikan = Ikan::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            // 'supplier_id' => missing
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $response->assertSessionHasErrors('supplier_id');
    }

    /**
     * Test: Validasi gagal saat ikan_id invalid
     */
    public function test_validasi_gagal_saat_ikan_id_invalid()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [99999], // Non-existent ikan
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $response->assertSessionHasErrors('ikan_id.0');
    }

    /**
     * Test: Validasi gagal saat jumlah_terima bernilai negatif
     */
    public function test_validasi_gagal_saat_jumlah_terima_bernilai_negatif()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [-10], // Negative value
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $response->assertSessionHasErrors('jumlah_terima.0');
    }

    /**
     * Test: Validasi gagal saat harga_beli bukan angka
     */
    public function test_validasi_gagal_saat_harga_beli_bukan_angka()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => ['not-a-number'], // Invalid
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $response->assertSessionHasErrors('harga_beli.0');
    }

    /**
     * Test: Transaksi dibatalkan saat terjadi error
     */
    public function test_transaksi_dibatalkan_saat_terjadi_error()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        // Mock StockService to throw an exception
        $this->mock(\App\Services\StockService::class, function ($mock) {
            $mock->shouldReceive('increaseStock')
                ->andThrow(new \Exception('Stock update failed'));
        });

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Assert redirect back with error
        $response->assertRedirect();
        // Check that there's an error message (your controller uses withErrors)
        $response->assertSessionHasErrors();

        // Assert no records were created (rollback successful)
        $this->assertDatabaseMissing('transaksi_pembelian', [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
        ]);

        $this->assertDatabaseMissing('detail_pembelian', [
            'ikan_id' => $ikan->id,
        ]);
    }

    /**
     * Test: Beberapa item dapat ditambahkan dalam satu transaksi
     */
    public function test_beberapa_item_dapat_ditambahkan_dalam_satu_transaksi()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan1 = Ikan::factory()->create();
        $ikan2 = Ikan::factory()->create();
        $ikan3 = Ikan::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan1->id, $ikan2->id, $ikan3->id],
            'jumlah_kirim' => [100, 200, 300],
            'jumlah_terima' => [95, 195, 290],
            'harga_beli' => [50000, 60000, 70000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $response->assertRedirect(route('admin.pembelian.index'));

        // Assert we have one transaksi with 3 details
        $transaksi = TransaksiPembelian::latest()->first();
        $this->assertNotNull($transaksi);
        $this->assertEquals(3, $transaksi->detail()->count());
    }

    /**
     * Test: Pembelian index menampilkan data yang benar
     */
    public function test_pembelian_index_menampilkan_data_yang_benar()
    {
        // Create test purchases
        $gudang = Gudang::factory()->create();
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        $transaksi = TransaksiPembelian::factory()->create([
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'admin_id' => $this->admin->id,
        ]);

        DetailPembelian::factory()->create([
            'transaksi_pembelian_id' => $transaksi->id,
            'ikan_id' => $ikan->id,
            'jumlah_kirim' => 100,
            'jumlah_terima' => 95,
            'harga_beli' => 50000,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.pembelian.index'));

        $response->assertStatus(200);
        $response->assertSee($supplier->nama_supplier);
        $response->assertSee($ikan->nama);
        $response->assertSee('100');
        $response->assertSee('95');
    }

    /**
     * Test: Stok bertambah dengan benar setelah pembelian
     */
    public function test_stok_bertambah_dengan_benar_setelah_pembelian()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        // Create initial stock
        StokGudang::create([
            'gudang_id' => $gudang->id,
            'ikan_id' => $ikan->id,
            'jumlah_stok' => 50,
        ]);

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Check stock increased by jumlah_terima (95)
        $stok = StokGudang::where('gudang_id', $gudang->id)
            ->where('ikan_id', $ikan->id)
            ->first();

        $this->assertEquals(145, $stok->jumlah_stok); // 50 + 95
    }

    /**
     * Test: Pembelian gagal ketika kapasitas gudang melebihi batas
     */
    public function test_pembelian_gagal_ketika_kapasitas_gudang_melebihi_batas()
    {
        // Create warehouse with small capacity
        $gudang = Gudang::factory()->create([
            'kapasitas_kg' => 100, // Only 100kg capacity
        ]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        // Try to purchase more than capacity
        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [200],
            'jumlah_terima' => [200], // 200kg exceeds 100kg capacity
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Assert error is returned
        $response->assertRedirect();
        $response->assertSessionHasErrors('error');

        // Verify no transaction was created (rollback)
        $this->assertDatabaseMissing('transaksi_pembelian', [
            'gudang_id' => $gudang->id,
        ]);
    }

    /**
     * Test: Pembelian dengan stok yang ada sesuai dengan kapasitas
     */
    public function test_pembelian_dengan_stok_yang_ada_sesuai_dengan_kapasitas()
    {
        $gudang = Gudang::factory()->create([
            'kapasitas_kg' => 200, // 200kg capacity
        ]);
        $supplier = Supplier::factory()->create();
        $ikan1 = Ikan::factory()->create();
        $ikan2 = Ikan::factory()->create();

        // Add existing stock of 150kg
        StokGudang::create([
            'gudang_id' => $gudang->id,
            'ikan_id' => $ikan1->id,
            'jumlah_stok' => 150,
        ]);

        // Try to add 100kg more (would exceed 200kg total)
        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan2->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [100],
            'harga_beli' => [50000],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Should fail due to capacity
        $response->assertRedirect();
        $response->assertSessionHasErrors('error');
    }

    /**
     * Test: Stok dibuat ketika stok ikan tidak tersedia di gudang.
     */
    public function test_stok_dibuat_ketika_tidak_ada()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        // Ensure no stock exists
        $this->assertDatabaseMissing('stok_gudang', [
            'gudang_id' => $gudang->id,
            'ikan_id' => $ikan->id,
        ]);

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Stock should be created with jumlah_terima value
        $this->assertDatabaseHas('stok_gudang', [
            'gudang_id' => $gudang->id,
            'ikan_id' => $ikan->id,
            'jumlah_stok' => 95,
        ]);
    }

    /**
     * Test: Catatan pembelian dengan admin_id yang benar
     */
    public function test_catatan_pembelian_dengan_admin_id_yang_benar()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        // Verify admin_id is recorded correctly
        $this->assertDatabaseHas('transaksi_pembelian', [
            'gudang_id' => $gudang->id,
            'admin_id' => $this->admin->id,
        ]);
    }

    /**
     * Test: Memastikan tanggal dan waktu pembelian tercatat dengan benar
     */
    public function test_memastikan_tanggal_dan_waktu_pembelian_tercatat_dengan_benar()
    {
        $gudang = Gudang::factory()->create(['kapasitas_kg' => 10000]);
        $supplier = Supplier::factory()->create();
        $ikan = Ikan::factory()->create();

        $purchaseData = [
            'gudang_id' => $gudang->id,
            'supplier_id' => $supplier->id,
            'ikan_id' => [$ikan->id],
            'jumlah_kirim' => [100],
            'jumlah_terima' => [95],
            'harga_beli' => [50000],
        ];

        $this->actingAs($this->admin)
            ->post(route('admin.pembelian.store'), $purchaseData);

        $transaksi = TransaksiPembelian::latest()->first();
        
        // Verify tanggal is set to today (compare as strings since it might not be a Carbon instance)
        $this->assertEquals(now()->format('Y-m-d'), date('Y-m-d', strtotime($transaksi->tanggal)));
    }
}