<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_inventaris" aria-controls="menu_inventaris"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M7,15L11.5,9L15,13.5L17.5,10.5L21,15M22,4H14L12,2H6A2,2 0 0,0 4,4V16A2,2 0 0,0 6,18H22A2,2 0 0,0 24,16V6A2,2 0 0,0 22,4M2,6H0V11H0V20A2,2 0 0,0 2,22H20V20H2V6Z" />
                </svg>
            </span>
            <span class="text">Postingan</span>
        </a>
        <ul id="menu_inventaris" class="{{ Request::routeIs('kreator.post.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('kreator.post.buat-post') }}"
                    class="{{ Request::routeIs('kreator.post.buat-post') ? 'active' : '' }}"> Buat Postingan </a>
            </li>
        </ul>
    </li>
    <span class="divider">
        <hr />
    </span>
</ul>
