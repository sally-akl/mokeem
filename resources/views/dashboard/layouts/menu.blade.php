<ul class="navbar-nav">
  <li class="nav-item {{$controller == 'DashboardController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.dashboard')
      </span>
    </a>
  </li>

  <li class="nav-item {{$controller == 'MokeemController' && $action == 'index' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/mokeem/boy/1")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.boy')
      </span>
    </a>
  </li>

  <li class="nav-item {{$controller == 'MokeemController' && $action == 'girl' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/mokeem/girl/2")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="5" r="2"></circle><path d="M10 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4"></path></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.girl')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'RelativeController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/relative")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="3" y="15" width="6" height="6" rx="2"></rect><rect x="15" y="15" width="6" height="6" rx="2"></rect><rect x="9" y="3" width="6" height="6" rx="2"></rect><path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1"></path><line x1="12" y1="9" x2="12" y2="12"></line></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.relative')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'VisitsController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/visit")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><line x1="9" y1="12" x2="9.01" y2="12"></line><line x1="13" y1="12" x2="15" y2="12"></line><line x1="9" y1="16" x2="9.01" y2="16"></line><line x1="13" y1="16" x2="15" y2="16"></line></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.visites')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'ArchiveController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/archive")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11"></path><line x1="8" y1="8" x2="12" y2="8"></line><line x1="8" y1="12" x2="12" y2="12"></line><line x1="8" y1="16" x2="12" y2="16"></line></svg>
      </span>
      <span class="nav-link-title">
       الارشيف
      </span>
    </a>
  </li>
</ul>
