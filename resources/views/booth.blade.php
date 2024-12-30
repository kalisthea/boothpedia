<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>{{ $event->name }}: My Booths</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>My Booths</h1>
            </div>
            @include('navheader')
        </div>
        <!-- Booth Content -->
        <div class="booth-detail">
            <div class="booth-detail-content">
                <h2 style="margin-bottom:30px;">{{ $event->name }}</h2>
                <p style="margin-bottom:30px;"><strong>Occupied Booths : </strong>17</p>
            </div>
            <div class="button-booth-container">
                <button class="upload-layout-button" onclick="document.getElementById('fileInput').click();">
                    <i class="fas fa-upload"></i>Upload Layout
                </button>
                <input type="file" id="fileInput" style="display: none;"/>
                <button class="add-category-button" onclick="showPopup('popup-cat');">
                    <i class="fa-solid fa-plus"></i>Add Category
                </button>
            </div>
        </div>
        
        <!-- Pop up Add Category -->
        <section class="popup-box" id="popup-cat" style="display:none;">
            <div class="popup-content">
                <div class="popup-header">
                    <h3 style="padding-bottom:20px;">Add Booth Category</h3>
                </div>
                <div style="border-bottom:1px solid black;"></div>
                <form id="createCategory" method="POST" action="{{ route('booth.categories.store', ['event_name' => $event->name]) }}">
                    @csrf
                    <div class="field-popup-box">
                        <div style="padding-bottom:20px;">
                            <label for="category" style="padding-bottom:20px;padding-top:20px;">Category Name</label>
                            <input type="text" id="category_name" name="category_name" class="category" placeholder="Input kategori booth..." required>
                        </div>
                        <div class="btn-popup-savecancel">
                            <button type="button" class="cancel-button" onclick="hidePopup('popup-cat')">Cancel</button>
                            <input type="submit" value="Save" class="submit-popup-button" style="margin-left:10px">
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
                        <option value="hidden">Select Category</option>  
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
                            <i class="fa-solid fa-plus"></i>Add Booth
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
                                            <div class="booth-price">Rp {{ number_format($booth->booth_price, 2, ',', '.') }}</div>
                                            <div class="booth-status">{{ $booth->is_occupied === 'Y' ? 'Occupied' : 'Available' }}</div>
                                            <div class="icon">
                                                <!-- <form action="" method="POST"  onsubmit="return confirmDeletion(this);">
                                                    @csrf
                                                    <button type="submit" class="icon-edit">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                                </form> -->
                                                
                                                <form action="{{ route('booth.delete', ['event_name' => $event->name, 'category_name' => $selectedCategory, 'id' => $booth->id]) }}" method="POST" onsubmit="return confirmDeletion(this, 'booth');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-delete">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
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
                                            <div class="booth-price">Rp {{ number_format($booth->booth_price, 2, ',', '.') }}</div>
                                            <div class="booth-status">{{ $booth->is_occupied === 'Y' ? 'Occupied' : 'Available' }}</div>
                                            <div class="icon">
                                                <!-- <form action="" method="POST"  onsubmit="return confirmDeletion(this, 'booth');">
                                                    @csrf
                                                    <button type="submit" class="icon-edit btn-link">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                                </form> -->
                                                
                                                <form action="{{ route('booth.delete', ['event_name' => $event->name, 'category_name' => $selectedCategory, 'id' => $booth->id]) }}" method="POST" onsubmit="return confirmDeletion(this, 'booth');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-delete btn-link">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
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
                    <h3 style="padding-bottom:20px;">Add New Booth</h3>
                </div>
                <div style="border-bottom:1px solid black;"></div>
                <form id="createBooth" method="POST" action="#">
                    @csrf
                    <input type="hidden" name="booth_category_id" id="selectedCategoryId"/>
                    <div class="field-popup-box">
                        <div style="padding-bottom:20px;">
                            <label for="booth-name" style="padding-bottom:20px;padding-top:20px;">Booth Name</label>
                            <input type="text" id="booth-name" name="booth_name" class="booth-name" placeholder="Input booth name..." required>
                        </div>
                        <div style="padding-bottom:20px;">
                            <label for="booth-price" style="padding-bottom:20px;padding-top:20px;">Booth Price</label>
                            <input type="number" id="booth-price" name="booth_price" class="booth-price" placeholder="Input booth price..." required>
                        </div>
                        <div class="btn-popup-savecancel">
                            <button type="button" class="cancel-button" onclick="hidePopup('popup-addbooth')">Cancel</button>
                            <input type="submit" value="Save" class="submit-popup-button" style="margin-left:10px">
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>