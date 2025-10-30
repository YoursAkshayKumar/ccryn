<!-- START HEADER -->
<header class="app-header">
  <div class="container-fluid">
    <div class="nav-header">

      <div class="header-left hstack gap-3">
      </div>

      <div class="header-right hstack gap-3">
        <!-- Profile Section -->
        <div class="dropdown profile-dropdown features-dropdown">
          <button type="button" id="accountNavbarDropdown" class="btn profile-btn shadow-none px-0 hstack gap-0 gap-sm-3" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
            <span class="position-relative">
              <span class="avatar-item avatar overflow-hidden">
                @php
                  if (Session::get('image') != '') {
                    $mediaImage = url('assets/images/admin/profile/'. Session::get('image'));
                  }else{
                    $mediaImage = url('assets/images/avatar/dummy-avatar.jpg');
                  }
                @endphp

                <img class="img-fluid" src="{{ $mediaImage }}" alt="avatar image">
              </span>
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
            </span>
            <span>
              <span class="h6 d-none d-xl-inline-block text-start fw-semibold mb-0">{{ Session::get('first_name').' '.Session::get('last_name') }}</span>
              <!-- <span class="d-none d-xl-block fs-12 text-start text-muted">CEO</span> -->
            </span>
          </button>

            @php
              $adminId = Session::get('admin_id');
            @endphp

          <div class="dropdown-menu dropdown$adminId-menu-end header-language-scrollable" aria-labelledby="accountNavbarDropdown">
            <a class="dropdown-item" href="{{ url(env('ADMIN_URL_PREFIX') . '/admin-profile/' . $adminId) }}">Profile</a>
            <a class="dropdown-item" href="{{ url(env('ADMIN_URL_PREFIX') . '/logout') }}">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</header>
<!-- END HEADER -->
