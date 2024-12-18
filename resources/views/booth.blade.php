<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Detail Event</title>
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
                <h2 style="margin-bottom:30px;">Social Gathering</h2>
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
                <div class="field-popup-box">
                    <div style="padding-bottom:20px;">
                        <label for="category" style="padding-bottom:20px;padding-top:20px;">Nama Kategori</label>
                        <input type="text" class="category" placeholder="Input kategori booth..." required>
                    </div>
                    <div class="btn-popup-savecancel">
                        <button class="cancel-button" onclick="hidePopup('popup-cat')">Batal</button>
                        <input type="submit" value="Simpan" class="submit-popup-button" style="margin-left:10px">
                    </div>
                </div>
            </div>
        </section>

        <!-- Pop up Add Booth -->
        <section class="popup-box" id="popup-addbooth" style="display:none;">
            <div class="popup-content">
                <div class="popup-header">
                    <h3 style="padding-bottom:20px;">Buat Booth Baru</h3>
                </div>
                <div style="border-bottom:1px solid black;"></div>
                <div class="field-popup-box">
                    <div style="padding-bottom:20px;">
                        <label for="booth-name" style="padding-bottom:20px;padding-top:20px;">Nama Booth</label>
                        <input type="text" class="booth-name" placeholder="Input nama booth..." required>
                    </div>
                    <div style="padding-bottom:20px;">
                        <label for="booth-price" style="padding-bottom:20px;padding-top:20px;">Nama Kategori</label>
                        <input type="number" class="booth-price" placeholder="Input harga booth..." required>
                    </div>
                    <div style="padding-bottom:20px;">
                        <label for="booth-desc" style="padding-bottom:20px;padding-top:20px;">Nama Kategori</label>
                        <input type="text" class="booth-desc" placeholder="Input deskripsi booth..." required>
                    </div>
                    <div class="btn-popup-savecancel">
                        <button class="cancel-button" onclick="hidePopup('popup-addbooth')">Batal</button>
                        <input type="submit" value="Simpan" class="submit-popup-button" style="margin-left:10px">
                    </div>
                </div>
            </div>
        </section>

        <!-- Booth List -->
        <div class="booth-list-container">
            <div class="booth-category">
                <select name="categoryDropdown" id="categoryDropdown">  
                    <option hidden>Pilih Kategori</option>  
                    <option value="">Bronze</option>
                    <option value="">Silver</option>
                    <option value="">Gold</option>
                </select>  
                <button id="viewButton">Lihat Booth</button>
            </div>
            <div class="booth-list">
                <button class="add-booth-button" onclick="showPopup('popup-addbooth');">
                    <i class="fa-solid fa-plus"></i>Tambah Booth
                </button>
                <!-- <div class="box">
                    <div class="left-side">
                        <div class="box-topic">JEON WONWOO</div>
                        <div class="card-div"></div>
                        <div class="box-sub">
                            <div class="account-num">1234567890</div>
                            <div class="bank-name">BANK SYARIAH INDONESIA</div>
                            <div class="icon">
                                <i class="fa-solid fa-circle-info icon-info"></i>
                                <i class="fa-regular fa-pen-to-square icon-edit"></i>
                                <i class="fa-regular fa-trash-can icon-delete"></i>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>