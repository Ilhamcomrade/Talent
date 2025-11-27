<style>
    .career-header {
        background-color: #0b0b54;
        padding: 40px 0 20px 0;
        text-align: center;
    }

    .career-search {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-box {
        position: relative;
        width: 900px;
        max-width: 95%;
    }

    .search-box input {
        width: 100%;
        padding: 12px 15px 12px 40px;
        border-radius: 8px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .search-box .fa-search {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #666;
        font-size: 16px;
    }

    .career-search button {
        background-color: #ff007f;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }

    /* ===== MENU FIX SESUAI GAMBAR ===== */
    .career-menu {
        background-color: #002e6d;
        padding: 0;
        text-align: center;
        margin-bottom: 40px;
    }

    .career-menu ul {
        list-style: none;
        margin: 0 auto;
        padding: 0;
        max-width: 1100px;
        display: flex;
        justify-content: space-between;
        align-items:stretch;
        height: 70px; /* ✅ DITINGGIKAN */
    }

    .career-menu ul li {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        border-radius: 0;
        transition: background-color 0.25s ease;
        height: 100%; /* ✅ pastikan ikut full tinggi */
    }

    .career-menu ul li a {
        color: inherit;
        text-decoration: none;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* ✅ warna hover diubah sesuai permintaan */
    .career-menu ul li:hover {
        background-color: #0b0b54;
    }

    /* ✅ active tetap sama */
    .career-menu ul li.active {
        background-color: #0077f6;
        font-weight: 600;
    }

    @media (max-width: 992px) {
        .career-menu ul {
            flex-wrap: wrap;
            height: auto;
        }
        .career-menu ul li {
            flex: 1 1 50%;
            height: 60px; /* versi mobile sedikit lebih pendek */
        }
    }
</style>

{{-- <div class="career-header">
    <form action="#" method="GET" class="career-search">
        {{-- <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Misalnya, perawat, rekayasawan, akuntan, penjualan..." />
        </div>
        <button type="submit">Cari</button> --}}
    {{-- </form>
</div> --}}

<div class="career-menu">
    <ul>
        <li class="{{ Route::is('career.explore') ? 'active' : '' }}">
            <a href="{{ route('career.explore') }}">Lowongan</a>
        </li>
        <li class="{{ Route::is('salary.explore') ? 'active' : '' }}">
            <a href="{{ route('salary.explore') }}">Pelamar</a>
        </li>
        {{-- <li class="{{ Route::is('job.search.page') ? 'active' : '' }}">
            <a href="{{ route('job.search.page') }}">Pencarian lowongan kerja</a>
        </li>
        <li class="{{ Route::is('job.life') ? 'active' : '' }}">
            <a href="{{ route('job.life') }}">Kehidupan kerja</a>
        </li> --}}
    </ul>
</div>
