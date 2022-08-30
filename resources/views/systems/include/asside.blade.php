<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home.page')?"":"collapsed" }}" href="{{ route('home.page') }}">
          <i class="bi bi-grid"></i>
          <span>ទំព័រដើម</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('sale.*')?"":"collapsed" }}" href="{{ route('sale.view') }}">
            <i class="bi bi-graph-up"></i>
            <span>ទិន្ន័យលក់</span>
          </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('reciev.product.*')?"":"collapsed" }}" href="{{ route('reciev.product.create') }}">
            <i class="bi bi-bag-plus"></i>
            <span>បន្ថែមទំនិញ</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ request()->routeIs('product.*')?"":"collapsed" }}" href="{{ route('product.index') }}">
            <i class="bi bi-bag"></i>
            <span> គ្រប់គ្រងមុខទំនិញ</span>
          </a>
      </li>


      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('category.*')?"":"collapsed" }}" href="{{ route('category.list') }}">
          <i class="bi bi-bar-chart-steps"></i>
          <span>ប្រភេទទំនិញ</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.*')?"":"collapsed" }}" href="{{ route("user.list") }}">
          <i class="bi bi-person-bounding-box"></i>
          <span>អ្នកគ្រប់គ្រង</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-images"></i>
          <span>បណ្ដុំរូបភាព</span>
        </a>
      </li><!-- End Contact Page Nav -->


    </ul>

  </aside>
