<div class="side-menu">
  <div class="brand-name">
    <h2><img src="{{ asset('images/Logo.png') }}" alt="" class="logo">Boothpedia</h2>
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
          <i class="fa-regular fa-calendar-check"></i>My Events
        </a>
      </li>
      <div class="divider"></div>
      <li class="{{ request()->routeIs('info') ? 'active' : '' }}"> 
          <a href="{{ route('info') }}"> 
              <i class="fa-regular fa-id-card"></i>Profile 
          </a> 
      </li>
      <li class="{{ request()->routeIs('verifprofile') ? 'active' : '' }}"> 
          <a href="{{ route('verifprofile') }}"> 
              <i class="fa-solid fa-user-check"></i>Profile Verification 
          </a> 
      </li>
      <li class="{{ request()->routeIs('bankaccount') ? 'active' : '' }}"> 
          <a href="{{ route('bankaccount') }}"> 
              <i class="fa-regular fa-credit-card"></i>Bank Account 
          </a> 
      </li>
      <li style="padding-top: 230px;">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">
            <i class="fa-solid fa-right-from-bracket"></i>Logout
          </button>
        </form>
      </li>
    </ul>
</div>

