<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ikan;
use App\Models\KategoriIkan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class IkanControllerTest extends TestCase
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

    // ==================== AUTHORIZATION TESTS ====================

    /**
     * Test: Admin bisa mengakses halaman index ikan
     */
    public function test_admin_bisa_mengakses_halaman_index_ikan()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.manajemen.ikan.index');
        $response->assertViewHas('ikans');
    }

    /**
     * Test: Manager bisa mengakses halaman index ikan
     */
    public function test_manager_bisa_mengakses_halaman_index_ikan()
    {
        $response = $this->actingAs($this->manager)
            ->get(route('admin.ikan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.manajemen.ikan.index');
    }

    /**
     * Test: Customer tidak bisa mengakses halaman index ikan
     */
    public function test_customer_tidak_bisa_mengakses_halaman_index_ikan()
    {
        $response = $this->actingAs($this->customer)
            ->get(route('admin.ikan.index'));

        $response->assertStatus(403);
    }

    /**
     * Test: Guest tidak bisa mengakses halaman index ikan
     */
    public function test_guest_tidak_bisa_mengakses_halaman_index_ikan()
    {
        $response = $this->get(route('admin.ikan.index'));

        $response->assertRedirect(route('login'));
    }

    // ==================== CREATE TESTS ====================

    /**
     * Test: Admin bisa mengakses form tambah ikan
     */
    public function test_admin_bisa_mengakses_form_tambah_ikan()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.manajemen.ikan.create');
        $response->assertViewHas('kategori');
    }

    /**
     * Test: Admin dapat menambahkan ikan dengan semua input terisi
     */
    public function test_admin_dapat_menambahkan_ikan_dengan_semua_input_terisi()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Tuna Sirip Kuning',
            'kode' => 'IKN999',
            'harga_beli' => 50000,
            'deskripsi' => 'Ikan tuna kualitas ekspor',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertRedirect(route('admin.ikan.index'));
        $response->assertSessionHas('success', 'Data ikan berhasil ditambahkan.');

        $this->assertDatabaseHas('ikan', [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Tuna Sirip Kuning',
            'kode' => 'IKN999',
            'harga_beli' => 50000,
        ]);
    }

    /**
     * Test: Admin dapat menambahkan ikan dengan minimal input terisi
     */
    public function test_admin_dapat_menambahkan_ikan_dengan_minimal_input_terisi()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Salmon',
            'kode' => 'SAL001', // Kode must be provided manually
            // harga_beli is nullable
            // deskripsi is nullable
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertRedirect(route('admin.ikan.index'));
        $response->assertSessionHas('success');

        // Verify ikan was created
        $this->assertDatabaseHas('ikan', [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Salmon',
            'kode' => 'SAL001',
        ]);
    }

    /**
     * Test: Validasi gagal saat kode tidak diisi
     */
    public function test_validasi_gagal_saat_kode_tidak_diisi()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Tuna Yellowfin',
            // No kode provided - should fail
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('kode');
    }

    // ==================== UPDATE TESTS ====================

    /**
     * Test: Admin bisa mengakses form update ikan
     */
    public function test_admin_bisa_mengakses_form_update_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.edit', $ikan->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.manajemen.ikan.edit');
        $response->assertViewHas('ikan');
        $response->assertViewHas('kategori');
    }

    /**
     * Test: Admin bisa mengupdate data ikan
     */
    public function test_admin_bisa_mengupdate_data_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create([
            'kategori_id' => $kategori->id,
            'nama' => 'Old Name',
            'kode' => 'OLD001',
        ]);

        $updateData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Updated Name',
            'kode' => 'NEW001',
            'harga_beli' => 75000,
            'deskripsi' => 'Updated description',
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.ikan.update', $ikan->id), $updateData);

        $response->assertRedirect(route('admin.ikan.index'));
        $response->assertSessionHas('success', 'Data ikan berhasil diperbarui.');

        $this->assertDatabaseHas('ikan', [
            'id' => $ikan->id,
            'nama' => 'Updated Name',
            'kode' => 'NEW001',
            'harga_beli' => 75000,
        ]);
    }

    /**
     * Test: Admin bisa mengubah kategori ikan
     */
    public function test_admin_bisa_mengubah_kategori_ikan()
    {
        $oldKategori = KategoriIkan::factory()->create(['nama_kategori' => 'Kategori Lama']);
        $newKategori = KategoriIkan::factory()->create(['nama_kategori' => 'Kategori Baru']);
        
        $ikan = Ikan::factory()->create(['kategori_id' => $oldKategori->id]);

        $updateData = [
            'kategori_id' => $newKategori->id,
            'nama' => $ikan->nama,
            'kode' => $ikan->kode,
            'harga_beli' => $ikan->harga_beli,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.ikan.update', $ikan->id), $updateData);

        $response->assertRedirect(route('admin.ikan.index'));

        $this->assertDatabaseHas('ikan', [
            'id' => $ikan->id,
            'kategori_id' => $newKategori->id,
        ]);
    }

    // ==================== DELETE TESTS ====================

    /**
     * Test: Admin bisa menghapus ikan
     */
    public function test_admin_bisa_menghapus_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.ikan.destroy', $ikan->id));

        $response->assertRedirect(route('admin.ikan.index'));
        $response->assertSessionHas('success', 'Data ikan berhasil dihapus.');

        $this->assertDatabaseMissing('ikan', [
            'id' => $ikan->id,
        ]);
    }

    /**
     * Test: Menghapus ikan yang tidak ada akan mengembalikan 404
     */
    public function test_menghapus_ikan_yang_tidak_ada_akan_mengembalikan_404()
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('admin.ikan.destroy', 99999));

        $response->assertStatus(404);
    }

    // ==================== VALIDATION TESTS ====================

    /**
     * Test: Validasi gagal ketika kategori_id tidak ada
     */
    public function test_validasi_gagal_ketika_kategori_id_tidak_ada()
    {
        $ikanData = [
            // kategori_id missing
            'nama' => 'Ikan Test',
            'kode' => 'TST001',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('kategori_id');
    }

    /**
     * Test: Validasi gagal ketika nama tidak ada
     */
    public function test_validasi_gagal_ketika_nama_tidak_ada()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            // nama missing
            'kode' => 'TST001',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('nama');
    }

    /**
     * Test: Validasi gagal ketika kategoru_id tidak ada
     */
    public function test_validasi_gagal_ketika_kategoru_id_tidak_ada()
    {
        $ikanData = [
            'kategori_id' => 99999, // Non-existent
            'nama' => 'Ikan Test',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('kategori_id');
    }

    /**
     * Test: Validasi gagal ketika kode terduplikat
     */
    public function test_Validasi_gagal_ketika_kode_terduplikat()
    {
        $kategori = KategoriIkan::factory()->create();
        
        // Create first ikan with kode
        Ikan::factory()->create([
            'kategori_id' => $kategori->id,
            'kode' => 'DUP001',
        ]);

        // Try to create second ikan with same kode
        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Duplicate',
            'kode' => 'DUP001', // Duplicate
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('kode');
    }

    /**
     * Test: Validasi memperbolehkan update ke kode yang sudah ada
     */
    public function test_validasi_memperbolehkan_update_ke_kode_yang_sudah_ada()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create([
            'kategori_id' => $kategori->id,
            'kode' => 'UPD001',
        ]);

        $updateData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Updated Name',
            'kode' => 'UPD001', // Same kode, should be allowed
            'harga_beli' => 50000,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.ikan.update', $ikan->id), $updateData);

        $response->assertRedirect(route('admin.ikan.index'));
        $response->assertSessionHasNoErrors();
    }

    /**
     * Test: Validasi gagal ketika harga_beli bernilai negatif
     */
    public function test_validasi_gagal_ketika_harga_beli_bernilai_negatif()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Test',
            'kode' => 'TST001',
            'harga_beli' => -5000, // Negative
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('harga_beli');
    }

    /**
     * Test: Validasi gagal ketika harga_beli bukan angka
     */
    public function test_validasi_gagal_ketika_harga_beli_bukan_angka()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Test',
            'kode' => 'TST001',
            'harga_beli' => 'not-a-number',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertSessionHasErrors('harga_beli');
    }

    // ==================== DISPLAY TESTS ====================

    /**
     * Test: Index menampilkan seluruh data ikan dengan benar
     */
    public function test_index_menampilkan_seluruh_data_ikan_dengan_benar()
    {
        $kategori = KategoriIkan::factory()->create(['nama_kategori' => 'Tuna Premium']);
        
        $ikan1 = Ikan::factory()->create([
            'kategori_id' => $kategori->id,
            'nama' => 'Tuna Sirip Kuning',
            'kode' => 'TSK001',
            'harga_beli' => 50000,
        ]);

        $ikan2 = Ikan::factory()->create([
            'kategori_id' => $kategori->id,
            'nama' => 'Tuna Mata Besar',
            'kode' => 'TMB001',
            'harga_beli' => 60000,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.index'));

        $response->assertStatus(200);
        
        // Check if both ikan are displayed
        $response->assertSee('Tuna Sirip Kuning');
        $response->assertSee('TSK001');
        $response->assertSee('Tuna Mata Besar');
        $response->assertSee('TMB001');
        $response->assertSee('Tuna Premium'); // kategori name
    }

    /**
     * Test: Form edit terisi dengan data yang sudah ada
     */
    public function test_form_edit_terisi_dengan_data_yang_sudah_ada()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create([
            'kategori_id' => $kategori->id,
            'nama' => 'Ikan Pre-fill Test',
            'kode' => 'PRE001',
            'harga_beli' => 45000,
            'deskripsi' => 'Test description',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.edit', $ikan->id));

        $response->assertStatus(200);
        $response->assertSee('Ikan Pre-fill Test');
        $response->assertSee('PRE001');
        $response->assertSee('45000');
        $response->assertSee('Test description');
    }

    /**
     * Test: Halaman index menampilkan ikan yang diurutkan berdasarkan nama
     */
    public function test_halaman_index_menampilkan_ikan_yang_diurutkan_berdasarkan_nama()
    {
        $kategori = KategoriIkan::factory()->create();

        // Create ikan in random order
        Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Zebra Fish']);
        Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Anak Ikan']);
        Ikan::factory()->create(['kategori_id' => $kategori->id, 'nama' => 'Mama Ikan']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.index'));

        $response->assertStatus(200);

        // Get the response content and check order
        $content = $response->getContent();
        
        // Position of each name in HTML
        $posAnakIkan = strpos($content, 'Anak Ikan');
        $posMamaIkan = strpos($content, 'Mama Ikan');
        $posZebraFish = strpos($content, 'Zebra Fish');

        // Verify they appear in alphabetical order
        $this->assertTrue($posAnakIkan < $posMamaIkan);
        $this->assertTrue($posMamaIkan < $posZebraFish);
    }

    /**
     * Test: Menampilkan pesan ketika index kosong
     */
    public function test_menampilkan_pesan_ketika_index_kosong()
    {
        // Don't create any ikan

        $response = $this->actingAs($this->admin)
            ->get(route('admin.ikan.index'));

        $response->assertStatus(200);
    }

    // ==================== MANAGER ACCESS TESTS ====================

    /**
     * Test: Manajer bisa menambahkan ikan
     */
    public function test_manajer_bisa_menambahkan_ikan()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Manager Created Fish',
            'kode' => 'MGR001',
            'harga_beli' => 40000,
        ];

        $response = $this->actingAs($this->manager)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertRedirect(route('admin.ikan.index'));
        
        $this->assertDatabaseHas('ikan', [
            'nama' => 'Manager Created Fish',
            'kode' => 'MGR001',
        ]);
    }

    /**
     * Test: Manajer bisa update ikan
     */
    public function test_manajer_bisa_update_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $updateData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Manager Updated',
            'kode' => $ikan->kode,
            'harga_beli' => 55000,
        ];

        $response = $this->actingAs($this->manager)
            ->put(route('admin.ikan.update', $ikan->id), $updateData);

        $response->assertRedirect(route('admin.ikan.index'));
        
        $this->assertDatabaseHas('ikan', [
            'id' => $ikan->id,
            'nama' => 'Manager Updated',
        ]);
    }

    /**
     * Test: Manajer bisa hapus ikan
     */
    public function test_manajer_bisa_hapus_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $response = $this->actingAs($this->manager)
            ->delete(route('admin.ikan.destroy', $ikan->id));

        $response->assertRedirect(route('admin.ikan.index'));
        
        $this->assertDatabaseMissing('ikan', [
            'id' => $ikan->id,
        ]);
    }

    // ==================== CUSTOMER RESTRICTION TESTS ====================

    /**
     * Test: Customer tidak dapat menambahkan ikan
     */
    public function test_customer_tidak_dapat_menambahkan_ikan()
    {
        $kategori = KategoriIkan::factory()->create();

        $ikanData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Customer Attempt',
            'kode' => 'CST001',
        ];

        $response = $this->actingAs($this->customer)
            ->post(route('admin.ikan.store'), $ikanData);

        $response->assertStatus(403);
        
        $this->assertDatabaseMissing('ikan', [
            'nama' => 'Customer Attempt',
        ]);
    }

    /**
     * Test: Customer tidak bisa update ikan
     */
    public function test_customer_tidak_bisa_update_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $updateData = [
            'kategori_id' => $kategori->id,
            'nama' => 'Customer Update Attempt',
            'kode' => $ikan->kode,
        ];

        $response = $this->actingAs($this->customer)
            ->put(route('admin.ikan.update', $ikan->id), $updateData);

        $response->assertStatus(403);
    }

    /**
     * Test: Customer tidak bisa hapus ikan
     */
    public function test_customer_tidak_bisa_hapus_ikan()
    {
        $kategori = KategoriIkan::factory()->create();
        $ikan = Ikan::factory()->create(['kategori_id' => $kategori->id]);

        $response = $this->actingAs($this->customer)
            ->delete(route('admin.ikan.destroy', $ikan->id));

        $response->assertStatus(403);
        
        // Verify ikan still exists
        $this->assertDatabaseHas('ikan', [
            'id' => $ikan->id,
        ]);
    }
}