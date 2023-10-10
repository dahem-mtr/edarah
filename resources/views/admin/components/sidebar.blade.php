<div class="sidebar collapsed">
    <div class="header">
      <a class="title"  href="{{ route('admin.index') }}" >

        {{ __('admin/main.edarah')}}
      </a>
    </div>

    <ul class="links">
      {{-- <div class="links-title"> الرئيسية</div> --}}

      <li class="link {{ Request::is('*/users*') ? 'active' : '' }}">
        <a href="{{route('admin.users.index')}}">
          <i class="bi bi-people-fill sidebar-icon"> </i> {{ __('admin/main.users')}}
        </a>
      </li>


      <li class="link">
        <a href="#"> <i class="bi bi-gear-fill"></i> {{ __('admin/main.settings')}}
        </a>
      </li>


    </ul>
  </div>
