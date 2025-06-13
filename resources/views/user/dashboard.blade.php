<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Dashboard - Berita Terkini</title>
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

        :root {
          --green-dark: #004d30;
          --green-mid: #007a4d;
          --green-light: #00b140;
          --green-accent: #61e786;
          --text-light: #e6f2e6;
          --bg-gradient-start: #003926;
          --bg-gradient-end: #005c3a;
          --card-bg: rgba(0, 123, 77, 0.9);
          --card-shadow: rgba(0, 0, 0, 0.6);
          --nav-bg: linear-gradient(135deg, rgba(0, 77, 48, 0.95), rgba(0, 123, 77, 0.85));
          --nav-hover: var(--green-accent);
        }

        * {
          box-sizing: border-box;
        }

        body {
          margin: 0;
          font-family: 'Poppins', sans-serif;
          background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
          color: var(--text-light);
          min-height: 100vh;
          display: flex;
          flex-direction: column;
        }

        header {
          background: var(--nav-bg);
          padding: 16px 32px;
          display: flex;
          align-items: center;
          justify-content: space-between;
          position: sticky;
          top: 0;
          z-index: 10000;
          box-shadow: 0 2px 12px var(--card-shadow);
          backdrop-filter: saturate(180%) blur(10px);
        }

        .logo {
          font-weight: 700;
          font-size: 1.75rem;
          color: var(--green-light);
          cursor: pointer;
          user-select: none;
          text-decoration: none;
          outline-offset: 2px;
          transition: color 0.3s ease;
        }
        .logo:hover,
        .logo:focus {
          color: var(--green-accent);
          outline: none;
          text-shadow: 0 0 8px var(--green-accent);
        }

        nav {
          display: flex;
          gap: 24px;
        }

        nav a {
          color: var(--text-light);
          text-decoration: none;
          font-weight: 600;
          font-size: 1rem;
          position: relative;
          padding: 6px 0;
          cursor: pointer;
          outline-offset: 2px;
          transition: color 0.3s ease, transform 0.2s ease;
        }

        nav a::after {
          content: '';
          position: absolute;
          bottom: -4px;
          left: 0;
          width: 0%;
          height: 2px;
          background: var(--nav-hover);
          border-radius: 2px;
          transition: width 0.3s ease;
          will-change: width;
        }

        nav a:hover,
        nav a:focus {
          color: var(--nav-hover);
          transform: scale(1.05);
          outline: none;
        }

        nav a:hover::after,
        nav a:focus::after {
          width: 100%;
        }

        /* Hamburger Menu */
        .hamburger {
          display: none;
          flex-direction: column;
          justify-content: space-between;
          width: 26px;
          height: 20px;
          cursor: pointer;
          z-index: 11000;
          background: var(--green-dark); /* Changed to use a variable */
          border-radius: 5px;
          padding: 4px;
        }
        .hamburger span {
          display: block;
          height: 3px;
          background: var(--text-light);
          border-radius: 2px;
          transition: all 0.3s ease;
          will-change: transform, opacity;
        }
        .hamburger:focus {
          outline: 3px solid var(--green-accent);
          outline-offset: 2px;
        }

        /* Mobile Nav */
        .mobile-nav {
          position: fixed;
          top: 0;
          right: -100vw;
          width: 70vw;
          max-width: 280px;
          height: 100vh;
          background: var(--nav-bg);
          backdrop-filter: saturate(180%) blur(12px);
          box-shadow: -4px 0 12px rgba(0,0,0,0.8);
          padding: 80px 24px 24px;
          display: flex;
          flex-direction: column;
          gap: 24px;
          transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
          z-index: 10500;
          overflow-y: auto;
        }

        .mobile-nav.show {
          right: 0;
        }

        .mobile-nav a {
          font-weight: 700;
          font-size: 1.2rem;
          color: var(--text-light);
          text-decoration: none;
          padding: 12px 0;
          border-bottom: 1px solid rgba(255,255,255,0.15);
          transition: color 0.3s ease;
        }

        .mobile-nav a:hover,
        .mobile-nav a:focus {
          color: var(--nav-hover);
          outline: none;
        }

        /* Hamburger active animation */
        .hamburger.active span:nth-child(1) {
          transform: translateY(8.5px) rotate(45deg);
        }
        .hamburger.active span:nth-child(2) {
          opacity: 0;
        }
        .hamburger.active span:nth-child(3) {
          transform: translateY(-8.5px) rotate(-45deg);
        }

        main {
          padding: 32px;
          flex-grow: 1;
          max-width: 1200px;
          margin: 0 auto;
          width: 100%;
        }

        .welcome {
          text-align: center;
          margin-bottom: 48px;
        }

        .welcome h2 {
          font-size: 2.25rem;
          margin-bottom: 8px;
          color: var(--green-accent);
          text-shadow: 1px 1px 4px rgba(0,0,0,0.75);
        }

        .welcome p {
          font-size: 1.125rem;
          color: #c9f7c9;
        }

        .section {
          margin-bottom: 56px;
        }

        .section h3 {
          color: var(--green-light);
          font-weight: 700;
          font-size: 1.75rem;
          margin-bottom: 24px;
          border-left: 6px solid var(--green-accent);
          padding-left: 12px;
          text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .cards {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
          gap: 24px;
        }

        .card {
          background: var(--card-bg);
          border-radius: 20px;
          box-shadow: 0 8px 16px var(--card-shadow);
          overflow: hidden;
          display: flex;
          flex-direction: column;
          cursor: pointer;
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover,
        .card:focus-within {
          transform: translateY(-8px);
          box-shadow: 0 16px 32px var(--card-shadow);
          outline: none;
        }

        .card img {
          width: 100%;
          height: 160px;
          object-fit: cover;
          border-bottom: 3px solid var(--green-accent);
        }

        .card-content {
          padding: 20px;
          flex-grow: 1;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
        }

        .card-title {
          font-weight: 700;
          font-size: 1.2rem;
          margin-bottom: 12px;
          color: var(--text-light);
          line-height: 1.3;
        }

        .card-desc {
          font-size: 0.9rem;
          color: #a0d7a0;
          flex-grow: 1;
          margin-bottom: 16px;
        }

        .card-footer {
          font-size: 0.85rem;
          color: #73b073;
        }

        footer {
          background: var(--green-dark);
          padding: 24px 32px;
          color: var(--text-light);
          text-align: center;
          font-size: 0.9rem;
          box-shadow: 0 -2px 8px var(--card-shadow);
        }

        @media (max-width: 1024px) {
          .cards {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
          }
        }

        @media (max-width: 640px) {
          header {
            padding: 12px 24px;
          }

          nav {
            display: none;
          }

          .hamburger {
            display: flex;
          }

          main {
            padding: 24px 16px;
          }

          .card img {
            height: 140px;
          }
        }
      </style>
    </head>
    <body>
      <header>
        <a href="{{ route('user.dashboard') }}" class="logo" tabindex="0">Berita Terkini</a>
        <nav aria-label="Primary navigation" role="navigation">
          <a href="{{ route('user.dashboard') }}" tabindex="0">Home</a>
          {{-- Contoh link kategori, bisa disesuaikan dengan rute Anda --}}
          <a href="#" tabindex="0">Nasional</a>
          <a href="#" tabindex="0">Internasional</a>
          <a href="#" tabindex="0">Olahraga</a>
          {{-- Link Logout --}}
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" tabindex="0">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </nav>
        <button class="hamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <nav id="mobile-menu" class="mobile-nav" aria-label="Mobile navigation">
          <a href="{{ route('user.dashboard') }}" tabindex="0">Home</a>
          {{-- Contoh link kategori untuk mobile --}}
          <a href="#" tabindex="0">Nasional</a>
          <a href="#" tabindex="0">Internasional</a>
          <a href="#" tabindex="0">Olahraga</a>
          {{-- Link Logout untuk mobile --}}
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" tabindex="0">Logout</a>
          <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </nav>
      </header>
      <main>
        <section class="welcome" aria-label="Welcome message">
          <h2>Selamat Datang, **{{ Auth::user()->name ?? 'Pengguna' }}**!</h2>
          <p>Ini adalah dashboard khusus yang dirancang untuk Anda sebagai pengguna biasa.</p>
          <p>Temukan berita terbaru dari berbagai kategori dan seluruh dunia di sini.</p>
        </section>

        <section class="section" aria-labelledby="latest-news-title">
          <h3 id="latest-news-title">Berita Terbaru</h3>
          <div class="cards">
            @forelse ($newsItems as $newsItem)
              <article class="card" tabindex="0" aria-label="Berita tentang {{ $newsItem->title }}">
                <img src="{{ asset('storage/' . $newsItem->image) }}"
                     alt="Gambar untuk berita: {{ $newsItem->title }}"
                     onerror="this.onerror=null;this.src='https://placehold.co/600x400/007a4d/e6f2e6?text=No+Image';this.alt='Tidak ada gambar tersedia';" />
                <div class="card-content">
                  <h4 class="card-title">{{ $newsItem->title }}</h4>
                  <p class="card-desc">
                    {{ Str::limit($newsItem->summary ?? $newsItem->body, 150) }} {{-- Gunakan summary atau potong body --}}
                  </p>
                  <div class="card-footer">
                    <time datetime="{{ $newsItem->created_at->format('Y-m-d') }}">
                        {{ $newsItem->created_at->format('d M Y') }}
                    </time>
                  </div>
                </div>
              </article>
            @empty
              <p style="text-align: center; width: 100%; color: #c9f7c9;">Belum ada berita terbaru yang tersedia saat ini.</p>
            @endforelse
          </div>
        </section>
      </main>
      <footer>
        &copy; 2025 Berita Terkini. All rights reserved.
      </footer>
    <script>
      const hamburger = document.querySelector('.hamburger');
      const mobileNav = document.getElementById('mobile-menu');

      hamburger.addEventListener('click', () => {
        const expanded = hamburger.getAttribute('aria-expanded') === 'true' || false;
        hamburger.setAttribute('aria-expanded', !expanded);
        hamburger.classList.toggle('active');
        mobileNav.classList.toggle('show');
      });

      // Close mobile menu on link click for better UX
      mobileNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          hamburger.classList.remove('active');
          mobileNav.classList.remove('show');
          hamburger.setAttribute('aria-expanded', false);
        });
      });

      // Close mobile menu on resize if desktop layout
      window.addEventListener('resize', () => {
        if(window.innerWidth > 640 && mobileNav.classList.contains('show')){
          hamburger.classList.remove('active');
          mobileNav.classList.remove('show');
          hamburger.setAttribute('aria-expanded', false);
        }
      });
    </script>
    </body>
    </html>
    