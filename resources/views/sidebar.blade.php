<div class="side-menu">
  <div class="brand-name">
    <h2><img src="img/logo.png" alt="" class="logo">Boothpedia</h2>
  </div>
  <div class="divider"></div>
    <ul>
      <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-home"></i>Dashboard
        </a>
      </li>
      <li class="{{ request()->routeIs('events') ? 'active' : '' }}">
        <a href="{{ route('events') }}">
          <i class="fa-regular fa-calendar-check"></i>Event Saya
        </a>
      </li>
      <div class="divider"></div>
      <!-- <li class="{{ request()->routeIs('info') ? 'active' : '' }}">
        <a href="{{ route('info') }}">
          <i class="fa-regular fa-id-card"></i>Informasi Dasar
        </a>
      </li>
      <li class="{{ request()->routeIs('verif') ? 'active' : '' }}">
        <a href="{{ route('verif') }}">
          <i class="fa-regular fa-calendar-check"></i>Verifikasi Profile
        </a>
      </li> -->
      <li class="{{ request()->routeIs('account') ? 'active' : '' }}">
        <a href="{{ route('account') }}">
        <i class="fa-regular fa-credit-card"></i>Rekening
        </a>
      </li>
      <!-- <li class="{{ request()->routeIs('events') ? 'active' : '' }}">
        <a href="{{ route('events') }}">
          <i class="fa-regular fa-calendar-check"></i>Keluar
        </a>
      </li> -->
    </ul>
</div>