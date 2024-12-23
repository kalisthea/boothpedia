<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>{{ $event->name }}: Booth Saya</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Booth Saya</h1>
            </div>
            @include('navheader')
        </div>
        <!-- Booth Content -->
        <div class="booth-detail">
            <div class="booth-detail-content">
                <h2 style="margin-bottom:30px;">{{ $event->name }}</h2>
                <p style="margin-bottom:30px;"><strong>Total Booth Terisi : </strong>17</p>
                <p style="margin-bottom:30px;"><strong>Total Penjualan    : </strong>Rp 30.000.000,-</p>
            </div>
            <div class="button-booth-container">
                <button class="upload-layout-button" onclick="document.getElementById('fileInput').click();">
                    <i class="fas fa-upload"></i>Unggah Layout
                </button>
                <input type="file" id="fileInput" style="display: none;"/>
                <button class="add-category-button" onclick="showPopup('popup-cat');">
                    <i class="fa-solid fa-plus"></i>Tambah Kategori
                </button>
            </div>
        </div>
        
        <!-- Pop up Add Category -->
        <section class="popup-box" id="popup-cat" style="display:none;">
            <div class="popup-content">
                <div class="popup-header">
                    <h3 style="padding-bottom:20px;">Tambah Kategori Booth</h3>
                </div>
                <div style="border-bottom:1px solid black;"></div>
                <form id="createCategory" method="POST" action="{{ route('booth.categories.store', ['event_name' => $event->name]) }}">
                    @csrf
                    <div class="field-popup-box">
                        <div style="padding-bottom:20px;">
                            <label for="category" style="padding-bottom:20px;padding-top:20px;">Nama Kategori</label>
                            <input type="text" id="category_name" name="category_name" class="category" placeholder="Input kategori booth..." required>
                        </div>
                        <div class="btn-popup-savecancel">
                            <button type="button" class="cancel-button" onclick="hidePopup('popup-cat')">Batal</button>
                            <input type="submit" value="Simpan" class="submit-popup-button" style="margin-left:10px">
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Booth List -->
        <div class="booth-list-container">
            <div class="booth-category">
                <form action="{{ route('mybooth', $event->name) }}" method="get" id="categoryForm">  
                    <select name="category_name" onchange="this.form.submit()" id="categoryDropdown">  
                        <option value="hidden">Pilih Kategori</option>  
                        @foreach($boothCategories as $category)  
                            <option value="{{ $category->id }}" {{ (isset($selectedCategory) && $selectedCategory == $category->id) ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>  
                        @endforeach  
                    </select>  
                </form>  
            </div>
            <div class="booth-list">
                <div class="booth-row first-row">
                    @if (isset($selectedCategory))
                        <button class="add-booth-button"  id="addBoothButton" style="display:flex;"
                                onclick="showPopupAddBooth('{{ $event->name }}', '{{ $selectedCategory }}', document.getElementById('categoryDropdown').options[document.getElementById('categoryDropdown').selectedIndex].text);">
                            <i class="fa-solid fa-plus"></i>Tambah Booth
                        </button>
                    @endif

                    @if ($booths && count($booths) > 0)
                        @foreach ($booths as $index => $booth)
                            @if ($index < 2)
                                <div class="booth-box">
                                    <div class="booth-left-side">
                                        <div class="booth-box-title">{{ $booth->booth_name }}</div>
                                        <div class="card-div"></div>
                                        <div class="booth-box-sub">
                                            <div class="booth-status">{{ $booth->is_occupied === 'Y' ? 'Terisi' : 'Kosong' }}</div>
                                            <div class="icon">
                                                <i class="fa-solid fa-circle-info icon-info"></i>
                                                <i class="fa-regular fa-pen-to-square icon-edit"></i>
                                                <i class="fa-regular fa-trash-can icon-delete"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="booth-row">
                    @if ($booths && count($booths) > 0)
                        @foreach ($booths as $index => $booth)
                            @if ($index >= 2)
                                <div class="booth-box">
                                    <div class="booth-left-side">
                                        <div class="booth-box-title">{{ $booth->booth_name }}</div>
                                        <div class="card-div"></div>
                                        <div class="booth-box-sub">
                                            <div class="booth-status">{{ $booth->is_occupied === 'Y' ? 'Terisi' : 'Kosong' }}</div>
                                            <div class="icon">
                                                <i class="fa-solid fa-circle-info icon-info"></i>
                                                <i class="fa-regular fa-pen-to-square icon-edit"></i>
                                                <i class="fa-regular fa-trash-can icon-delete"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Pop up Add Booth -->
        <section class="popup-box" id="popup-addbooth" style="display:none;">
            <div class="popup-content">
                <div class="popup-header">
                    <h3 style="padding-bottom:20px;">Buat Booth Baru</h3>
                </div>
                <div style="border-bottom:1px solid black;"></div>
                <form id="createBooth" method="POST" action="#">
                    @csrf
                    <input type="hidden" name="booth_category_id" id="selectedCategoryId"/>
                    <div class="field-popup-box">
                        <div style="padding-bottom:20px;">
                            <label for="booth-name" style="padding-bottom:20px;padding-top:20px;">Nama Booth</label>
                            <input type="text" id="booth-name" name="booth_name" class="booth-name" placeholder="Input nama booth..." required>
                        </div>
                        <div style="padding-bottom:20px;">
                            <label for="booth-price" style="padding-bottom:20px;padding-top:20px;">Harga Booth</label>
                            <input type="number" id="booth-price" name="booth_price" class="booth-price" placeholder="Input harga booth..." required>
                        </div>
                        <div style="padding-bottom:20px;">
                            <label for="booth-desc" style="padding-bottom:20px;padding-top:20px;">Deskripsi Booth</label>
                            <input type="text" id="booth-desc" name="booth_description" class="booth-desc" placeholder="Input deskripsi booth..." required>
                        </div>
                        <div class="btn-popup-savecancel">
                            <button type="button" class="cancel-button" onclick="hidePopup('popup-addbooth')">Batal</button>
                            <input type="submit" value="Simpan" class="submit-popup-button" style="margin-left:10px">
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>