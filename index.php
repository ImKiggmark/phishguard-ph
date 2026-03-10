<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PhishGuard PH — Report Phishing Incidents</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    /* ============================================================
       DESIGN TOKENS
    ============================================================ */
    :root {
      /* Colors */
      --color-primary:        #1d4ed8;
      --color-primary-dark:   #1e3a8a;
      --color-primary-light:  #3b82f6;
      --color-primary-bg:     #eff6ff;
      --color-secondary:      #0f172a;
      --color-accent:         #f59e0b;
      --color-accent-light:   #fef3c7;
      --color-success:        #16a34a;
      --color-success-bg:     #f0fdf4;
      --color-danger:         #dc2626;
      --color-danger-bg:      #fef2f2;
      --color-warning:        #d97706;
      --color-warning-bg:     #fffbeb;
      --color-white:          #ffffff;
      --color-gray-50:        #f8fafc;
      --color-gray-100:       #f1f5f9;
      --color-gray-200:       #e2e8f0;
      --color-gray-300:       #cbd5e1;
      --color-gray-400:       #94a3b8;
      --color-gray-500:       #64748b;
      --color-gray-600:       #475569;
      --color-gray-700:       #334155;
      --color-gray-800:       #1e293b;
      --color-gray-900:       #0f172a;

      /* Typography */
      --font-family-base:     'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      --font-size-xs:         0.75rem;
      --font-size-sm:         0.875rem;
      --font-size-base:       1rem;
      --font-size-lg:         1.125rem;
      --font-size-xl:         1.25rem;
      --font-size-2xl:        1.5rem;
      --font-size-3xl:        1.875rem;
      --font-size-4xl:        2.25rem;
      --font-size-5xl:        3rem;
      --font-size-6xl:        3.75rem;

      /* Spacing */
      --space-1:   0.25rem;
      --space-2:   0.5rem;
      --space-3:   0.75rem;
      --space-4:   1rem;
      --space-5:   1.25rem;
      --space-6:   1.5rem;
      --space-8:   2rem;
      --space-10:  2.5rem;
      --space-12:  3rem;
      --space-16:  4rem;
      --space-20:  5rem;
      --space-24:  6rem;
      --space-32:  8rem;

      /* Border Radius */
      --radius-sm:   0.25rem;
      --radius-md:   0.5rem;
      --radius-lg:   0.75rem;
      --radius-xl:   1rem;
      --radius-2xl:  1.5rem;
      --radius-full: 9999px;

      /* Shadows */
      --shadow-sm:  0 1px 2px rgba(0,0,0,0.05);
      --shadow-md:  0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
      --shadow-lg:  0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
      --shadow-xl:  0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
      --shadow-blue: 0 4px 14px 0 rgba(29,78,216,0.25);
    }

    /* ============================================================
       RESET & BASE
    ============================================================ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: var(--font-family-base);
      font-size: var(--font-size-base);
      color: var(--color-gray-800);
      background-color: var(--color-white);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }
    ul { list-style: none; }
    button { cursor: pointer; font-family: inherit; }

    /* ============================================================
       NAVBAR
    ============================================================ */
    .navbar {
      position: sticky;
      top: 0;
      z-index: 100;
      background: var(--color-white);
      border-bottom: 1px solid var(--color-gray-200);
      box-shadow: var(--shadow-sm);
    }
    .navbar__inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 var(--space-6);
      height: 68px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: var(--space-8);
    }
    .navbar__brand {
      display: flex;
      align-items: center;
      gap: var(--space-3);
      flex-shrink: 0;
    }
    .navbar__logo {
      width: 36px;
      height: 36px;
      background: var(--color-primary);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .navbar__logo svg { width: 20px; height: 20px; }
    .navbar__brand-text {
      font-size: var(--font-size-xl);
      font-weight: 800;
      color: var(--color-primary-dark);
      letter-spacing: -0.02em;
    }
    .navbar__brand-text span { color: var(--color-primary-light); }
    .navbar__nav {
      display: flex;
      align-items: center;
      gap: var(--space-1);
      flex: 1;
      justify-content: center;
    }
    .navbar__nav-link {
      font-size: var(--font-size-sm);
      font-weight: 500;
      color: var(--color-gray-600);
      padding: var(--space-2) var(--space-4);
      border-radius: var(--radius-md);
      transition: color 0.15s, background 0.15s;
    }
    .navbar__nav-link:hover {
      color: var(--color-primary);
      background: var(--color-primary-bg);
    }
    .navbar__nav-link--active {
      color: var(--color-primary);
      background: var(--color-primary-bg);
      font-weight: 600;
    }
    .navbar__actions {
      display: flex;
      align-items: center;
      gap: var(--space-3);
      flex-shrink: 0;
    }
    .navbar__hamburger {
      display: none;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 5px;
      width: 40px;
      height: 40px;
      background: transparent;
      border: none;
      border-radius: var(--radius-md);
      padding: var(--space-2);
      transition: background 0.15s;
    }
    .navbar__hamburger:hover { background: var(--color-gray-100); }
    .navbar__hamburger-bar {
      width: 22px;
      height: 2px;
      background: var(--color-gray-700);
      border-radius: 2px;
      transition: transform 0.25s, opacity 0.25s;
    }
    .navbar__hamburger[aria-expanded="true"] .navbar__hamburger-bar:nth-child(1) {
      transform: translateY(7px) rotate(45deg);
    }
    .navbar__hamburger[aria-expanded="true"] .navbar__hamburger-bar:nth-child(2) {
      opacity: 0;
    }
    .navbar__hamburger[aria-expanded="true"] .navbar__hamburger-bar:nth-child(3) {
      transform: translateY(-7px) rotate(-45deg);
    }
    .navbar__mobile-menu {
      display: none;
      flex-direction: column;
      padding: var(--space-4) var(--space-6);
      border-top: 1px solid var(--color-gray-100);
      background: var(--color-white);
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease, padding 0.3s ease;
    }
    .navbar__mobile-menu--open {
      max-height: 500px;
      padding: var(--space-4) var(--space-6);
    }
    .navbar__mobile-link {
      font-size: var(--font-size-base);
      font-weight: 500;
      color: var(--color-gray-700);
      padding: var(--space-3) var(--space-4);
      border-radius: var(--radius-md);
      transition: background 0.15s, color 0.15s;
    }
    .navbar__mobile-link:hover {
      background: var(--color-primary-bg);
      color: var(--color-primary);
    }
    .navbar__mobile-actions {
      display: flex;
      flex-direction: column;
      gap: var(--space-3);
      margin-top: var(--space-4);
      padding-top: var(--space-4);
      border-top: 1px solid var(--color-gray-100);
    }

    /* ============================================================
       BUTTONS
    ============================================================ */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: var(--space-2);
      font-size: var(--font-size-sm);
      font-weight: 600;
      padding: var(--space-2) var(--space-5);
      border-radius: var(--radius-md);
      border: 1.5px solid transparent;
      transition: all 0.15s;
      white-space: nowrap;
      line-height: 1.4;
    }
    .btn--sm {
      font-size: var(--font-size-xs);
      padding: var(--space-1) var(--space-3);
    }
    .btn--lg {
      font-size: var(--font-size-base);
      padding: var(--space-3) var(--space-8);
      border-radius: var(--radius-lg);
    }
    .btn--primary {
      background: var(--color-primary);
      color: var(--color-white);
      border-color: var(--color-primary);
      box-shadow: var(--shadow-blue);
    }
    .btn--primary:hover {
      background: var(--color-primary-dark);
      border-color: var(--color-primary-dark);
    }
    .btn--outline {
      background: transparent;
      color: var(--color-primary);
      border-color: var(--color-primary);
    }
    .btn--outline:hover {
      background: var(--color-primary-bg);
    }
    .btn--ghost {
      background: transparent;
      color: var(--color-gray-700);
      border-color: transparent;
    }
    .btn--ghost:hover {
      background: var(--color-gray-100);
    }
    .btn--danger {
      background: var(--color-danger);
      color: var(--color-white);
      border-color: var(--color-danger);
    }
    .btn--full { width: 100%; }

    /* ============================================================
       BADGES
    ============================================================ */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: var(--space-1);
      font-size: var(--font-size-xs);
      font-weight: 600;
      padding: 2px var(--space-3);
      border-radius: var(--radius-full);
      letter-spacing: 0.02em;
      text-transform: uppercase;
    }
    .badge--blue  { background: var(--color-primary-bg);  color: var(--color-primary); }
    .badge--green { background: var(--color-success-bg); color: var(--color-success); }
    .badge--red   { background: var(--color-danger-bg);  color: var(--color-danger); }
    .badge--amber { background: var(--color-warning-bg); color: var(--color-warning); }
    .badge--gray  { background: var(--color-gray-100);   color: var(--color-gray-600); }

    /* ============================================================
       HERO SECTION
    ============================================================ */
    .hero {
      background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 50%, #2563eb 100%);
      padding: var(--space-24) var(--space-6);
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse at 20% 50%, rgba(255,255,255,0.06) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%);
      pointer-events: none;
    }
    .hero::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0; right: 0;
      height: 80px;
      background: var(--color-white);
      clip-path: ellipse(55% 100% at 50% 100%);
    }
    .hero__inner {
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--space-16);
      align-items: center;
      position: relative;
      z-index: 1;
    }
    .hero__content {}
    .hero__eyebrow {
      display: inline-flex;
      align-items: center;
      gap: var(--space-2);
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(8px);
      color: var(--color-white);
      font-size: var(--font-size-sm);
      font-weight: 600;
      padding: var(--space-2) var(--space-4);
      border-radius: var(--radius-full);
      border: 1px solid rgba(255,255,255,0.2);
      margin-bottom: var(--space-6);
    }
    .hero__eyebrow-dot {
      width: 8px; height: 8px;
      background: #4ade80;
      border-radius: 50%;
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.6; transform: scale(1.2); }
    }
    .hero__title {
      font-size: var(--font-size-5xl);
      font-weight: 800;
      color: var(--color-white);
      line-height: 1.15;
      letter-spacing: -0.03em;
      margin-bottom: var(--space-6);
    }
    .hero__title-accent { color: #93c5fd; }
    .hero__desc {
      font-size: var(--font-size-lg);
      color: rgba(255,255,255,0.8);
      line-height: 1.7;
      margin-bottom: var(--space-8);
      max-width: 480px;
    }
    .hero__cta {
      display: flex;
      align-items: center;
      gap: var(--space-4);
      flex-wrap: wrap;
    }
    .hero__stats {
      display: flex;
      gap: var(--space-8);
      margin-top: var(--space-10);
      padding-top: var(--space-8);
      border-top: 1px solid rgba(255,255,255,0.2);
    }
    .hero__stat-number {
      font-size: var(--font-size-2xl);
      font-weight: 800;
      color: var(--color-white);
      line-height: 1;
    }
    .hero__stat-label {
      font-size: var(--font-size-xs);
      color: rgba(255,255,255,0.65);
      margin-top: var(--space-1);
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
    }
    .hero__visual {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .hero__card-stack {
      position: relative;
      width: 400px;
      height: 340px;
    }
    .hero__card {
      position: absolute;
      background: var(--color-white);
      border-radius: var(--radius-2xl);
      padding: var(--space-6);
      box-shadow: var(--shadow-xl);
    }
    .hero__card--main {
      width: 340px;
      top: 20px;
      left: 0;
      z-index: 3;
    }
    .hero__card--back {
      width: 300px;
      top: 0;
      right: 0;
      z-index: 2;
      opacity: 0.7;
      transform: rotate(4deg);
    }
    .hero__card-title {
      font-size: var(--font-size-sm);
      font-weight: 700;
      color: var(--color-gray-800);
      margin-bottom: var(--space-3);
      display: flex;
      align-items: center;
      gap: var(--space-2);
    }
    .hero__card-icon {
      width: 32px; height: 32px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero__card-icon--red { background: var(--color-danger-bg); }
    .hero__card-icon--blue { background: var(--color-primary-bg); }
    .hero__card-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: var(--space-2) 0;
      border-bottom: 1px solid var(--color-gray-100);
      font-size: var(--font-size-xs);
      color: var(--color-gray-600);
    }
    .hero__card-row:last-child { border-bottom: none; }
    .hero__card-row strong { color: var(--color-gray-800); font-weight: 600; }

    /* ============================================================
       SECTION WRAPPER
    ============================================================ */
    .section {
      padding: var(--space-20) var(--space-6);
    }
    .section--gray { background: var(--color-gray-50); }
    .section--dark {
      background: var(--color-gray-900);
      color: var(--color-white);
    }
    .section__inner {
      max-width: 1280px;
      margin: 0 auto;
    }
    .section__header {
      text-align: center;
      margin-bottom: var(--space-16);
    }
    .section__eyebrow {
      font-size: var(--font-size-sm);
      font-weight: 700;
      color: var(--color-primary);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: var(--space-3);
    }
    .section--dark .section__eyebrow { color: #93c5fd; }
    .section__title {
      font-size: var(--font-size-4xl);
      font-weight: 800;
      color: var(--color-gray-900);
      letter-spacing: -0.03em;
      line-height: 1.2;
      margin-bottom: var(--space-4);
    }
    .section--dark .section__title { color: var(--color-white); }
    .section__subtitle {
      font-size: var(--font-size-lg);
      color: var(--color-gray-500);
      max-width: 560px;
      margin: 0 auto;
      line-height: 1.7;
    }
    .section--dark .section__subtitle { color: var(--color-gray-400); }

    /* ============================================================
       FEATURES SECTION
    ============================================================ */
    .features__grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: var(--space-8);
    }
    .feature-card {
      background: var(--color-white);
      border: 1px solid var(--color-gray-200);
      border-radius: var(--radius-xl);
      padding: var(--space-8);
      transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }
    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-color: var(--color-primary-light);
    }
    .feature-card__icon {
      width: 52px; height: 52px;
      border-radius: var(--radius-lg);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: var(--space-5);
    }
    .feature-card__icon--blue   { background: var(--color-primary-bg); }
    .feature-card__icon--green  { background: var(--color-success-bg); }
    .feature-card__icon--amber  { background: var(--color-accent-light); }
    .feature-card__icon--red    { background: var(--color-danger-bg); }
    .feature-card__icon--purple { background: #f3e8ff; }
    .feature-card__icon--teal   { background: #f0fdfa; }
    .feature-card__title {
      font-size: var(--font-size-lg);
      font-weight: 700;
      color: var(--color-gray-900);
      margin-bottom: var(--space-3);
    }
    .feature-card__desc {
      font-size: var(--font-size-sm);
      color: var(--color-gray-500);
      line-height: 1.7;
    }

    /* ============================================================
       HOW IT WORKS SECTION
    ============================================================ */
    .how-it-works__grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: var(--space-6);
      position: relative;
    }
    .how-it-works__grid::before {
      content: '';
      position: absolute;
      top: 32px;
      left: 12.5%;
      width: 75%;
      height: 2px;
      background: linear-gradient(90deg, var(--color-primary-bg), var(--color-primary), var(--color-primary-bg));
      z-index: 0;
    }
    .step-card {
      text-align: center;
      position: relative;
      z-index: 1;
    }
    .step-card__number {
      width: 64px; height: 64px;
      border-radius: 50%;
      background: var(--color-primary);
      color: var(--color-white);
      font-size: var(--font-size-xl);
      font-weight: 800;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto var(--space-5);
      box-shadow: var(--shadow-blue);
      border: 4px solid var(--color-white);
    }
    .step-card__title {
      font-size: var(--font-size-base);
      font-weight: 700;
      color: var(--color-gray-900);
      margin-bottom: var(--space-2);
    }
    .step-card__desc {
      font-size: var(--font-size-sm);
      color: var(--color-gray-500);
      line-height: 1.65;
    }

    /* ============================================================
       STATS SECTION
    ============================================================ */
    .stats__grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: var(--space-6);
    }
    .stat-card {
      text-align: center;
      padding: var(--space-8);
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: var(--radius-xl);
      backdrop-filter: blur(10px);
    }
    .stat-card__number {
      font-size: var(--font-size-5xl);
      font-weight: 800;
      color: var(--color-white);
      line-height: 1;
      letter-spacing: -0.03em;
    }
    .stat-card__suffix {
      font-size: var(--font-size-3xl);
      color: #93c5fd;
    }
    .stat-card__label {
      font-size: var(--font-size-sm);
      color: var(--color-gray-400);
      margin-top: var(--space-2);
      font-weight: 500;
    }

    /* ============================================================
       RECENT THREATS SECTION
    ============================================================ */
    .threats__grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: var(--space-6);
    }
    .threat-card {
      background: var(--color-white);
      border: 1px solid var(--color-gray-200);
      border-radius: var(--radius-xl);
      padding: var(--space-6);
      transition: box-shadow 0.2s;
    }
    .threat-card:hover { box-shadow: var(--shadow-md); }
    .threat-card__header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: var(--space-4);
    }
    .threat-card__type {
      font-size: var(--font-size-xs);
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }
    .threat-card__title {
      font-size: var(--font-size-base);
      font-weight: 700;
      color: var(--color-gray-900);
      margin-bottom: var(--space-2);
      line-height: 1.4;
    }
    .threat-card__desc {
      font-size: var(--font-size-sm);
      color: var(--color-gray-500);
      line-height: 1.65;
      margin-bottom: var(--space-4);
    }
    .threat-card__footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: var(--font-size-xs);
      color: var(--color-gray-400);
    }
    .threat-card__footer strong { color: var(--color-gray-600); }

    /* ============================================================
       DASHBOARD PREVIEW SECTION
    ============================================================ */
    .dashboard-preview {
      background: var(--color-primary-bg);
      padding: var(--space-20) var(--space-6);
    }
    .dashboard-preview__inner {
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1.2fr;
      gap: var(--space-16);
      align-items: center;
    }
    .dashboard-preview__content {}
    .dashboard-preview__feature-list {
      display: flex;
      flex-direction: column;
      gap: var(--space-4);
      margin: var(--space-8) 0;
    }
    .dashboard-preview__feature {
      display: flex;
      align-items: flex-start;
      gap: var(--space-4);
    }
    .dashboard-preview__feature-icon {
      width: 40px; height: 40px;
      border-radius: var(--radius-md);
      background: var(--color-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .dashboard-preview__feature-text h4 {
      font-size: var(--font-size-sm);
      font-weight: 700;
      color: var(--color-gray-900);
      margin-bottom: 2px;
    }
    .dashboard-preview__feature-text p {
      font-size: var(--font-size-sm);
      color: var(--color-gray-500);
    }
    .dashboard-preview__mockup {
      background: var(--color-white);
      border-radius: var(--radius-2xl);
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      border: 1px solid var(--color-gray-200);
    }
    .mockup__topbar {
      background: var(--color-gray-800);
      padding: var(--space-3) var(--space-4);
      display: flex;
      align-items: center;
      gap: var(--space-2);
    }
    .mockup__dot {
      width: 12px; height: 12px; border-radius: 50%;
    }
    .mockup__dot--red   { background: #ef4444; }
    .mockup__dot--yellow { background: #f59e0b; }
    .mockup__dot--green { background: #22c55e; }
    .mockup__url-bar {
      flex: 1;
      background: var(--color-gray-700);
      border-radius: var(--radius-sm);
      height: 24px;
      margin: 0 var(--space-3);
      display: flex;
      align-items: center;
      padding: 0 var(--space-3);
    }
    .mockup__url-text {
      font-size: 11px;
      color: var(--color-gray-400);
      font-family: monospace;
    }
    .mockup__body {
      padding: var(--space-5);
    }
    .mockup__sidebar {
      display: flex;
      gap: var(--space-4);
    }
    .mockup__nav {
      width: 140px;
      flex-shrink: 0;
    }
    .mockup__nav-item {
      display: flex;
      align-items: center;
      gap: var(--space-2);
      padding: var(--space-2) var(--space-3);
      border-radius: var(--radius-md);
      font-size: 11px;
      color: var(--color-gray-600);
      margin-bottom: 2px;
    }
    .mockup__nav-item--active {
      background: var(--color-primary-bg);
      color: var(--color-primary);
      font-weight: 600;
    }
    .mockup__nav-dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: currentColor;
    }
    .mockup__content { flex: 1; }
    .mockup__kpi-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: var(--space-3);
      margin-bottom: var(--space-4);
    }
    .mockup__kpi {
      background: var(--color-gray-50);
      border-radius: var(--radius-md);
      padding: var(--space-3);
    }
    .mockup__kpi-val {
      font-size: var(--font-size-xl);
      font-weight: 800;
      color: var(--color-gray-900);
    }
    .mockup__kpi-label {
      font-size: 10px;
      color: var(--color-gray-500);
      margin-top: 2px;
    }
    .mockup__table-row {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      gap: var(--space-2);
      padding: var(--space-2) 0;
      border-bottom: 1px solid var(--color-gray-100);
      align-items: center;
    }
    .mockup__table-row:last-child { border-bottom: none; }
    .mockup__table-cell { font-size: 10px; color: var(--color-gray-600); }
    .mockup__table-cell--header { font-weight: 700; color: var(--color-gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-size: 9px; }
    .mockup__pill {
      display: inline-block;
      font-size: 9px;
      font-weight: 600;
      padding: 1px 6px;
      border-radius: var(--radius-full);
    }
    .mockup__pill--pending  { background: var(--color-warning-bg); color: var(--color-warning); }
    .mockup__pill--verified { background: var(--color-success-bg); color: var(--color-success); }
    .mockup__pill--new      { background: var(--color-primary-bg); color: var(--color-primary); }

    /* ============================================================
       CTA SECTION
    ============================================================ */
    .cta {
      padding: var(--space-20) var(--space-6);
      background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%);
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .cta::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 30% 50%, rgba(255,255,255,0.07) 0%, transparent 50%),
        radial-gradient(circle at 70% 50%, rgba(255,255,255,0.05) 0%, transparent 50%);
      pointer-events: none;
    }
    .cta__inner {
      max-width: 640px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }
    .cta__title {
      font-size: var(--font-size-4xl);
      font-weight: 800;
      color: var(--color-white);
      letter-spacing: -0.03em;
      line-height: 1.2;
      margin-bottom: var(--space-5);
    }
    .cta__desc {
      font-size: var(--font-size-lg);
      color: rgba(255,255,255,0.75);
      margin-bottom: var(--space-8);
      line-height: 1.7;
    }
    .cta__buttons {
      display: flex;
      justify-content: center;
      gap: var(--space-4);
      flex-wrap: wrap;
    }
    .btn--white {
      background: var(--color-white);
      color: var(--color-primary);
      border-color: var(--color-white);
      box-shadow: var(--shadow-md);
    }
    .btn--white:hover {
      background: var(--color-gray-100);
    }
    .btn--outline-white {
      background: transparent;
      color: var(--color-white);
      border-color: rgba(255,255,255,0.5);
    }
    .btn--outline-white:hover {
      background: rgba(255,255,255,0.1);
      border-color: var(--color-white);
    }

    /* ============================================================
       FOOTER
    ============================================================ */
    footer {
      background: var(--color-gray-900);
      color: var(--color-gray-400);
      padding: var(--space-16) var(--space-6) var(--space-8);
    }
    .footer__inner {
      max-width: 1280px;
      margin: 0 auto;
    }
    .footer__top {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: var(--space-12);
      padding-bottom: var(--space-12);
      border-bottom: 1px solid var(--color-gray-800);
    }
    .footer__brand {}
    .footer__brand-logo {
      display: flex;
      align-items: center;
      gap: var(--space-3);
      margin-bottom: var(--space-4);
    }
    .footer__brand-icon {
      width: 36px; height: 36px;
      background: var(--color-primary);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .footer__brand-name {
      font-size: var(--font-size-xl);
      font-weight: 800;
      color: var(--color-white);
    }
    .footer__brand-desc {
      font-size: var(--font-size-sm);
      line-height: 1.7;
      max-width: 280px;
    }
    .footer__col-title {
      font-size: var(--font-size-sm);
      font-weight: 700;
      color: var(--color-white);
      margin-bottom: var(--space-4);
      letter-spacing: 0.03em;
    }
    .footer__links {
      display: flex;
      flex-direction: column;
      gap: var(--space-3);
    }
    .footer__link {
      font-size: var(--font-size-sm);
      color: var(--color-gray-400);
      transition: color 0.15s;
    }
    .footer__link:hover { color: var(--color-white); }
    .footer__bottom {
      padding-top: var(--space-8);
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: var(--font-size-sm);
      flex-wrap: wrap;
      gap: var(--space-4);
    }
    .footer__bottom-links {
      display: flex;
      gap: var(--space-6);
    }
    .footer__bottom-link {
      color: var(--color-gray-500);
      transition: color 0.15s;
    }
    .footer__bottom-link:hover { color: var(--color-white); }

    /* ============================================================
       ALERT BANNER
    ============================================================ */
    .alert-banner {
      background: var(--color-danger);
      color: var(--color-white);
      padding: var(--space-2) var(--space-6);
      font-size: var(--font-size-sm);
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: var(--space-3);
    }
    .alert-banner__icon { font-size: var(--font-size-base); }
    .alert-banner__link {
      color: var(--color-white);
      font-weight: 700;
      text-decoration: underline;
    }

    /* ============================================================
       FORM STYLES (for modal)
    ============================================================ */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: var(--space-4);
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s;
    }
    .modal-overlay--open {
      opacity: 1;
      pointer-events: all;
    }
    .modal {
      background: var(--color-white);
      border-radius: var(--radius-2xl);
      padding: var(--space-8);
      width: 100%;
      max-width: 480px;
      box-shadow: var(--shadow-xl);
      transform: translateY(20px);
      transition: transform 0.2s;
    }
    .modal-overlay--open .modal {
      transform: translateY(0);
    }
    .modal__header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: var(--space-6);
    }
    .modal__title {
      font-size: var(--font-size-xl);
      font-weight: 800;
      color: var(--color-gray-900);
    }
    .modal__close {
      width: 32px; height: 32px;
      border: none;
      background: var(--color-gray-100);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: var(--font-size-lg);
      color: var(--color-gray-500);
      transition: background 0.15s;
    }
    .modal__close:hover { background: var(--color-gray-200); }
    .form-group {
      margin-bottom: var(--space-5);
    }
    .form-label {
      display: block;
      font-size: var(--font-size-sm);
      font-weight: 600;
      color: var(--color-gray-700);
      margin-bottom: var(--space-2);
    }
    .form-input,
    .form-select,
    .form-textarea {
      width: 100%;
      padding: var(--space-3) var(--space-4);
      border: 1.5px solid var(--color-gray-200);
      border-radius: var(--radius-md);
      font-size: var(--font-size-sm);
      font-family: inherit;
      color: var(--color-gray-800);
      background: var(--color-white);
      transition: border-color 0.15s, box-shadow 0.15s;
      outline: none;
    }
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(29,78,216,0.12);
    }
    .form-textarea { resize: vertical; min-height: 100px; }
    .form-tabs {
      display: flex;
      border: 1.5px solid var(--color-gray-200);
      border-radius: var(--radius-md);
      overflow: hidden;
      margin-bottom: var(--space-6);
    }
    .form-tab {
      flex: 1;
      padding: var(--space-2);
      text-align: center;
      font-size: var(--font-size-sm);
      font-weight: 600;
      background: transparent;
      border: none;
      color: var(--color-gray-500);
      transition: background 0.15s, color 0.15s;
    }
    .form-tab--active {
      background: var(--color-primary);
      color: var(--color-white);
    }
    .form-divider {
      text-align: center;
      font-size: var(--font-size-xs);
      color: var(--color-gray-400);
      margin: var(--space-4) 0;
      position: relative;
    }
    .form-divider::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0; right: 0;
      height: 1px;
      background: var(--color-gray-200);
      z-index: 0;
    }
    .form-divider span {
      position: relative;
      z-index: 1;
      background: var(--color-white);
      padding: 0 var(--space-3);
    }

    /* ============================================================
       TRUST BADGES
    ============================================================ */
    .trust-bar {
      background: var(--color-white);
      padding: var(--space-8) var(--space-6);
      border-top: 1px solid var(--color-gray-100);
      border-bottom: 1px solid var(--color-gray-100);
    }
    .trust-bar__inner {
      max-width: 1280px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: var(--space-12);
      flex-wrap: wrap;
    }
    .trust-bar__item {
      display: flex;
      align-items: center;
      gap: var(--space-3);
      font-size: var(--font-size-sm);
      font-weight: 600;
      color: var(--color-gray-600);
    }
    .trust-bar__icon {
      width: 40px; height: 40px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: var(--font-size-lg);
    }
    .trust-bar__icon--blue { background: var(--color-primary-bg); }
    .trust-bar__icon--green { background: var(--color-success-bg); }
    .trust-bar__icon--amber { background: var(--color-accent-light); }

    /* ============================================================
       RESPONSIVE — TABLET
    ============================================================ */
    @media (max-width: 1024px) {
      .navbar__nav,
      .navbar__actions { display: none !important; }
      .navbar__hamburger { display: flex; }
      .navbar__mobile-menu { display: flex; }

      .hero__inner { grid-template-columns: 1fr; text-align: center; gap: var(--space-12); }
      .hero__desc { margin-left: auto; margin-right: auto; }
      .hero__cta { justify-content: center; }
      .hero__stats { justify-content: center; }
      .hero__visual { display: none; }

      .features__grid { grid-template-columns: repeat(2, 1fr); }
      .how-it-works__grid { grid-template-columns: repeat(2, 1fr); }
      .how-it-works__grid::before { display: none; }
      .stats__grid { grid-template-columns: repeat(2, 1fr); }
      .threats__grid { grid-template-columns: repeat(2, 1fr); }

      .dashboard-preview__inner { grid-template-columns: 1fr; }
      .dashboard-preview__mockup { max-width: 540px; margin: 0 auto; }

      .footer__top { grid-template-columns: 1fr 1fr; gap: var(--space-8); }
      .footer__bottom { flex-direction: column; align-items: flex-start; }
    }

    /* ============================================================
       RESPONSIVE — MOBILE
    ============================================================ */
    @media (max-width: 768px) {
      .hero { padding: var(--space-16) var(--space-4); }
      .hero__title { font-size: var(--font-size-4xl); }
      .hero__stats { flex-direction: column; gap: var(--space-4); align-items: center; }

      .section { padding: var(--space-16) var(--space-4); }
      .section__title { font-size: var(--font-size-3xl); }
      .section__header { margin-bottom: var(--space-10); }

      .features__grid { grid-template-columns: 1fr; }
      .how-it-works__grid { grid-template-columns: 1fr; }
      .stats__grid { grid-template-columns: 1fr 1fr; }
      .threats__grid { grid-template-columns: 1fr; }

      .dashboard-preview { padding: var(--space-16) var(--space-4); }
      .dashboard-preview__inner { gap: var(--space-10); }

      .cta { padding: var(--space-16) var(--space-4); }
      .cta__title { font-size: var(--font-size-3xl); }
      .cta__buttons { flex-direction: column; align-items: center; }
      .cta__buttons .btn { width: 100%; max-width: 320px; }

      .trust-bar__inner { gap: var(--space-6); justify-content: flex-start; }

      .footer__top { grid-template-columns: 1fr; gap: var(--space-8); }
      .footer__bottom-links { flex-wrap: wrap; gap: var(--space-4); }

      .navbar__inner { padding: 0 var(--space-4); }
      .navbar__mobile-menu { padding-left: var(--space-4); padding-right: var(--space-4); }
    }
  </style>
</head>
<body>

  <!-- ALERT BANNER -->
  <div class="alert-banner" role="alert">
    <span class="alert-banner__icon">⚠️</span>
    <span>New phishing campaign targeting BDO and BPI customers detected. <a class="alert-banner__link" href="#report">Report an incident →</a></span>
  </div>

  <!-- ============================================================
       NAVBAR
  ============================================================ -->
  <header>
    <nav class="navbar" role="navigation" aria-label="Main navigation">
      <div class="navbar__inner">
        <!-- Brand -->
        <a href="/" class="navbar__brand" aria-label="PhishGuard PH Home">
          <div class="navbar__logo" aria-hidden="true">
            <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 2L3 6v4c0 4.418 3.013 8.548 7 9.5C17 18.548 17 14.418 17 10V6L10 2z" fill="white" opacity="0.9"/>
              <path d="M7 10l2 2 4-4" stroke="#1d4ed8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="navbar__brand-text">PhishGuard <span>PH</span></span>
        </a>

        <!-- Desktop Nav -->
        <ul class="navbar__nav" role="list">
          <li><a href="#home"     class="navbar__nav-link navbar__nav-link--active">Home</a></li>
          <li><a href="#features" class="navbar__nav-link">Features</a></li>
          <li><a href="#report"   class="navbar__nav-link">Report</a></li>
          <li><a href="#threats"  class="navbar__nav-link">Threats</a></li>
          <li><a href="#about"    class="navbar__nav-link">About</a></li>
        </ul>

        <!-- Desktop Actions -->
        <div class="navbar__actions">
          <a href="login.php" class="btn btn--ghost">Sign In</a>
          <a href="register.php" class="btn btn--primary">Register Free</a>
        </div>

        <!-- Hamburger -->
        <button
          class="navbar__hamburger"
          id="hamburger-btn"
          aria-label="Toggle navigation menu"
          aria-expanded="false"
          aria-controls="mobile-menu"
          onclick="toggleMobileMenu()"
        >
          <span class="navbar__hamburger-bar"></span>
          <span class="navbar__hamburger-bar"></span>
          <span class="navbar__hamburger-bar"></span>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div class="navbar__mobile-menu" id="mobile-menu" role="menu" aria-labelledby="hamburger-btn">
        <a href="#home"     class="navbar__mobile-link" role="menuitem">Home</a>
        <a href="#features" class="navbar__mobile-link" role="menuitem">Features</a>
        <a href="#report"   class="navbar__mobile-link" role="menuitem">Report</a>
        <a href="#threats"  class="navbar__mobile-link" role="menuitem">Threats</a>
        <a href="#about"    class="navbar__mobile-link" role="menuitem">About</a>
        <div class="navbar__mobile-actions">
          <a href="login.php" class="btn btn--outline btn--full">Sign In</a>
          <a href="register.php" class="btn btn--primary btn--full">Register Free</a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <!-- ============================================================
         HERO SECTION
    ============================================================ -->
    <section id="home" class="hero" aria-labelledby="hero-heading">
      <div class="hero__inner">
        <!-- Content -->
        <div class="hero__content">
          <div class="hero__eyebrow">
            <span class="hero__eyebrow-dot" aria-hidden="true"></span>
            Protecting Filipino Internet Users
          </div>

          <h1 class="hero__title" id="hero-heading">
            Report & Fight<br/>
            <span class="hero__title-accent">Phishing Attacks</span><br/>
            in the Philippines
          </h1>

          <p class="hero__desc">
            PhishGuard PH empowers Filipinos to report phishing incidents, 
            protect their digital identities, and contribute to a safer 
            Philippine cyberspace.
          </p>

          <div class="hero__cta">
            <a href="reports/submit_report.php" class="btn btn--white btn--lg">Report Phishing</a>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
              </svg>
              Report Phishing
            </button>
            <button class="btn btn--outline-white btn--lg" onclick="openModal('login')">
              View My Reports
            </button>
          </div>

          <div class="hero__stats" role="list" aria-label="Platform statistics">
            <div class="hero__stat" role="listitem">
              <div class="hero__stat-number">12,400+</div>
              <div class="hero__stat-label">Incidents Reported</div>
            </div>
            <div class="hero__stat" role="listitem">
              <div class="hero__stat-number">98%</div>
              <div class="hero__stat-label">Verification Rate</div>
            </div>
            <div class="hero__stat" role="listitem">
              <div class="hero__stat-number">340+</div>
              <div class="hero__stat-label">Sites Taken Down</div>
            </div>
          </div>
        </div>

        <!-- Visual: Floating Cards -->
        <div class="hero__visual" aria-hidden="true">
          <div class="hero__card-stack">
            <!-- Main card -->
            <div class="hero__card hero__card--main">
              <div class="hero__card-title">
                <div class="hero__card-icon hero__card-icon--red">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2">
                    <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                  </svg>
                </div>
                Recent Phishing Report
              </div>
              <div class="hero__card-row">
                <span>URL</span>
                <strong>fake-bdo-login.xyz</strong>
              </div>
              <div class="hero__card-row">
                <span>Type</span>
                <strong>Banking Phish</strong>
              </div>
              <div class="hero__card-row">
                <span>Status</span>
                <span class="badge badge--red">Verified Threat</span>
              </div>
              <div class="hero__card-row">
                <span>Reported</span>
                <strong>2 hrs ago</strong>
              </div>
            </div>
            <!-- Back card -->
            <div class="hero__card hero__card--back">
              <div class="hero__card-title">
                <div class="hero__card-icon hero__card-icon--blue">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                Admin Verified
              </div>
              <div class="hero__card-row">
                <span>Reports Today</span>
                <strong>47</strong>
              </div>
              <div class="hero__card-row">
                <span>Resolved</span>
                <strong>38</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
         TRUST BAR
    ============================================================ -->
    <div class="trust-bar" role="complementary" aria-label="Trust indicators">
      <div class="trust-bar__inner">
        <div class="trust-bar__item">
          <div class="trust-bar__icon trust-bar__icon--blue" aria-hidden="true">🛡️</div>
          <span>DICT Aligned</span>
        </div>
        <div class="trust-bar__item">
          <div class="trust-bar__icon trust-bar__icon--green" aria-hidden="true">✅</div>
          <span>NPC Compliant</span>
        </div>
        <div class="trust-bar__item">
          <div class="trust-bar__icon trust-bar__icon--amber" aria-hidden="true">🔒</div>
          <span>End-to-End Encrypted</span>
        </div>
        <div class="trust-bar__item">
          <div class="trust-bar__icon trust-bar__icon--blue" aria-hidden="true">🏛️</div>
          <span>CICC Supported</span>
        </div>
        <div class="trust-bar__item">
          <div class="trust-bar__icon trust-bar__icon--green" aria-hidden="true">📊</div>
          <span>Open Data Initiative</span>
        </div>
      </div>
    </div>

    <!-- ============================================================
         FEATURES SECTION
    ============================================================ -->
    <section id="features" class="section" aria-labelledby="features-heading">
      <div class="section__inner">
        <header class="section__header">
          <p class="section__eyebrow">Platform Features</p>
          <h2 class="section__title" id="features-heading">
            Everything You Need to Fight Phishing
          </h2>
          <p class="section__subtitle">
            Powerful tools for citizens and administrators to collaboratively 
            identify and neutralize phishing threats across the Philippines.
          </p>
        </header>

        <div class="features__grid" role="list">
          <article class="feature-card" role="listitem">
            <div class="feature-card__icon feature-card__icon--blue" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                <path d="M4 4l16 16M9.5 9.5a3.5 3.5 0 104.95 4.95"/>
                <path d="M10.73 5.08A10.43 10.43 0 0112 5c7 0 10 7 10 7a13.16 13.16 0 01-1.67 2.68M6.61 6.61A13.526 13.526 0 002 12s3 7 10 7a9.74 9.74 0 005.39-1.61"/>
              </svg>
            </div>
            <h3 class="feature-card__title">Easy Incident Reporting</h3>
            <p class="feature-card__desc">
              Submit phishing reports in under 2 minutes. Paste the suspicious URL, 
              describe what happened, and attach screenshots for faster verification.
            </p>
          </article>

          <article class="feature-card" role="listitem">
            <div class="feature-card__icon feature-card__icon--green" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="feature-card__title">Expert Verification</h3>
            <p class="feature-card__desc">
              Our trained admin team reviews every report and confirms genuine threats 
              within 24 hours, ensuring accurate and reliable incident data.
            </p>
          </article>

          <article class="feature-card" role="listitem">
            <div class="feature-card__icon feature-card__icon--amber" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
              </svg>
            </div>
            <h3 class="feature-card__title">Real-Time Alerts</h3>
            <p class="feature-card__desc">
              Get notified when new phishing campaigns are detected in your area 
              or targeting your bank, email provider, or government services.
            </p>
          </article>

          <article class="feature-card" role="listitem">
            <div class="feature-card__icon feature-card__icon--red" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2">
                <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <h3 class="feature-card__title">Detailed Report Tracking</h3>
            <p class="feature-card__desc">
              Follow the status of your submitted reports from review to resolution. 
              Know exactly when your report has been actioned upon.
            </p>
          </article>

          <article class="feature-card" role="listitem">
            <div class="feature-card__icon feature-card__icon--purple" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2">
                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <h3 class="feature-card__title">Community Protection</h3>
            <p class="feature-card__desc">
              Every report you submit protects other Filipinos. Our shared 
              threat database helps organizations and individuals stay informed.
            </p>
          </article>

          <article class="feature-card" role="listitem">
            <div class="feature-card__icon feature-card__icon--teal" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2">
                <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <h3 class="feature-card__title">Secure & Anonymous</h3>
            <p class="feature-card__desc">
              Reports can be filed anonymously. All submitted data is encrypted 
              and handled in compliance with the Philippine Data Privacy Act.
            </p>
          </article>
        </div>
      </div>
    </section>

    <!-- ============================================================
         HOW IT WORKS
    ============================================================ -->
    <section class="section section--gray" aria-labelledby="how-heading">
      <div class="section__inner">
        <header class="section__header">
          <p class="section__eyebrow">Simple Process</p>
          <h2 class="section__title" id="how-heading">How PhishGuard PH Works</h2>
          <p class="section__subtitle">
            Four simple steps to report phishing and help protect fellow Filipinos.
          </p>
        </header>

        <div class="how-it-works__grid" role="list">
          <div class="step-card" role="listitem">
            <div class="step-card__number" aria-hidden="true">1</div>
            <h3 class="step-card__title">Encounter a Phishing Site</h3>
            <p class="step-card__desc">
              You come across a suspicious website, email, or SMS that looks like 
              it may be impersonating a legitimate Philippine institution.
            </p>
          </div>
          <div class="step-card" role="listitem">
            <div class="step-card__number" aria-hidden="true">2</div>
            <h3 class="step-card__title">Submit Your Report</h3>
            <p class="step-card__desc">
              Log in or report anonymously. Paste the URL, select the category, 
              describe the incident, and upload any screenshots.
            </p>
          </div>
          <div class="step-card" role="listitem">
            <div class="step-card__number" aria-hidden="true">3</div>
            <h3 class="step-card__title">Admin Verification</h3>
            <p class="step-card__desc">
              Our security team analyzes the submitted URL, verifies the threat, 
              and updates the report status accordingly.
            </p>
          </div>
          <div class="step-card" role="listitem">
            <div class="step-card__number" aria-hidden="true">4</div>
            <h3 class="step-card__title">Threat Neutralized</h3>
            <p class="step-card__desc">
              Verified threats are escalated to relevant authorities and 
              domain registrars to have the phishing sites taken down.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
         STATS SECTION
    ============================================================ -->
    <section class="section section--dark" aria-labelledby="stats-heading">
      <div class="section__inner">
        <header class="section__header">
          <p class="section__eyebrow">By The Numbers</p>
          <h2 class="section__title" id="stats-heading">Our Impact on Philippine Cybersecurity</h2>
          <p class="section__subtitle">
            Real results from our community-driven phishing reporting platform.
          </p>
        </header>

        <div class="stats__grid" role="list">
          <div class="stat-card" role="listitem">
            <div class="stat-card__number">12.4<span class="stat-card__suffix">K</span></div>
            <div class="stat-card__label">Total Incidents Reported</div>
          </div>
          <div class="stat-card" role="listitem">
            <div class="stat-card__number">8.9<span class="stat-card__suffix">K</span></div>
            <div class="stat-card__label">Verified Phishing URLs</div>
          </div>
          <div class="stat-card" role="listitem">
            <div class="stat-card__number">340<span class="stat-card__suffix">+</span></div>
            <div class="stat-card__label">Sites Successfully Removed</div>
          </div>
          <div class="stat-card" role="listitem">
            <div class="stat-card__number">25<span class="stat-card__suffix">K</span></div>
            <div class="stat-card__label">Registered Users Protected</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
         RECENT THREATS SECTION
    ============================================================ -->
    <section id="threats" class="section" aria-labelledby="threats-heading">
      <div class="section__inner">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: var(--space-12); flex-wrap: wrap; gap: var(--space-4);">
          <div>
            <p class="section__eyebrow" style="text-align:left; margin-bottom: var(--space-2);">Threat Intelligence</p>
            <h2 class="section__title" style="text-align:left; margin-bottom:0;" id="threats-heading">Recent Phishing Campaigns</h2>
          </div>
          <button class="btn btn--outline">View All Threats</button>
        </div>

        <div class="threats__grid" role="list">
          <article class="threat-card" role="listitem">
            <div class="threat-card__header">
              <span class="badge badge--red">Banking</span>
              <span class="badge badge--gray">2 hrs ago</span>
            </div>
            <h3 class="threat-card__title">Fake BDO Online Banking Login Page</h3>
            <p class="threat-card__desc">
              A clone of BDO Unibank's internet banking portal has been identified, 
              harvesting credentials from unsuspecting customers via SMS phishing links.
            </p>
            <div class="threat-card__footer">
              <span>🔗 fake-bdo-login.xyz</span>
              <span class="badge badge--red">Active</span>
            </div>
          </article>

          <article class="threat-card" role="listitem">
            <div class="threat-card__header">
              <span class="badge badge--amber">Government</span>
              <span class="badge badge--gray">5 hrs ago</span>
            </div>
            <h3 class="threat-card__title">Fake PhilHealth Benefits Claims Portal</h3>
            <p class="threat-card__desc">
              Fraudulent website impersonating PhilHealth prompting members to submit 
              personal information and bank details to claim "COVID-19 benefits."
            </p>
            <div class="threat-card__footer">
              <span>🔗 philhealth-benefits.net</span>
              <span class="badge badge--amber">Under Review</span>
            </div>
          </article>

          <article class="threat-card" role="listitem">
            <div class="threat-card__header">
              <span class="badge badge--blue">E-Commerce</span>
              <span class="badge badge--gray">1 day ago</span>
            </div>
            <h3 class="threat-card__title">Fake Lazada Flash Sale Credential Harvester</h3>
            <p class="threat-card__desc">
              A phishing page mimicking Lazada's promotional page offering 90% off 
              vouchers, redirecting users to a credential harvesting form.
            </p>
            <div class="threat-card__footer">
              <span>🔗 lazada-flash-promo.co</span>
              <span class="badge badge--green">Resolved</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ============================================================
         DASHBOARD PREVIEW
    ============================================================ -->
    <section class="dashboard-preview" id="about" aria-labelledby="dashboard-heading">
      <div class="dashboard-preview__inner">
        <!-- Content -->
        <div class="dashboard-preview__content">
          <p class="section__eyebrow">User Dashboard</p>
          <h2 class="section__title" style="text-align:left;" id="dashboard-heading">
            Track Your Reports<br/>in Real Time
          </h2>
          <p style="font-size: var(--font-size-base); color: var(--color-gray-500); line-height: 1.7; margin-bottom: var(--space-6);">
            Once registered, your personal dashboard gives you full visibility 
            into every report you've submitted — from pending review to full resolution.
          </p>

          <div class="dashboard-preview__feature-list">
            <div class="dashboard-preview__feature">
              <div class="dashboard-preview__feature-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                  <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"/>
                </svg>
              </div>
              <div class="dashboard-preview__feature-text">
                <h4>Live Status Updates</h4>
                <p>See when your report moves from Pending → Under Review → Verified</p>
              </div>
            </div>
            <div class="dashboard-preview__feature">
              <div class="dashboard-preview__feature-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                  <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
              </div>
              <div class="dashboard-preview__feature-text">
                <h4>Email Notifications</h4>
                <p>Get notified the moment your report status changes</p>
              </div>
            </div>
            <div class="dashboard-preview__feature">
              <div class="dashboard-preview__feature-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                  <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <div class="dashboard-preview__feature-text">
                <h4>Secure Report History</h4>
                <p>Access all your past reports any time, fully encrypted</p>
              </div>
            </div>
          </div>

          <button class="btn btn--primary btn--lg" onclick="openModal('register')">
            Create Free Account
          </button>
        </div>

        <!-- Mockup Dashboard -->
        <div class="dashboard-preview__mockup" aria-hidden="true" role="img" aria-label="Screenshot of PhishGuard PH user dashboard">
          <div class="mockup__topbar">
            <div class="mockup__dot mockup__dot--red"></div>
            <div class="mockup__dot mockup__dot--yellow"></div>
            <div class="mockup__dot mockup__dot--green"></div>
            <div class="mockup__url-bar">
              <span class="mockup__url-text">https://phishguard.ph/dashboard</span>
            </div>
          </div>
          <div class="mockup__body">
            <div class="mockup__sidebar">
              <div class="mockup__nav">
                <div class="mockup__nav-item mockup__nav-item--active">
                  <div class="mockup__nav-dot"></div> Dashboard
                </div>
                <div class="mockup__nav-item">
                  <div class="mockup__nav-dot"></div> Submit Report
                </div>
                <div class="mockup__nav-item">
                  <div class="mockup__nav-dot"></div> My Reports
                </div>
                <div class="mockup__nav-item">
                  <div class="mockup__nav-dot"></div> Profile
                </div>
              </div>
              <div class="mockup__content">
                <div class="mockup__kpi-row">
                  <div class="mockup__kpi">
                    <div class="mockup__kpi-val">12</div>
                    <div class="mockup__kpi-label">Total Reports</div>
                  </div>
                  <div class="mockup__kpi">
                    <div class="mockup__kpi-val">8</div>
                    <div class="mockup__kpi-label">Verified</div>
                  </div>
                  <div class="mockup__kpi">
                    <div class="mockup__kpi-val">3</div>
                    <div class="mockup__kpi-label">Pending</div>
                  </div>
                </div>
                <div>
                  <div class="mockup__table-row">
                    <div class="mockup__table-cell mockup__table-cell--header">URL</div>
                    <div class="mockup__table-cell mockup__table-cell--header">Type</div>
                    <div class="mockup__table-cell mockup__table-cell--header">Status</div>
                  </div>
                  <div class="mockup__table-row">
                    <div class="mockup__table-cell">fake-bdo-login.xyz</div>
                    <div class="mockup__table-cell">Banking</div>
                    <div class="mockup__table-cell"><span class="mockup__pill mockup__pill--verified">Verified</span></div>
                  </div>
                  <div class="mockup__table-row">
                    <div class="mockup__table-cell">gcash-promo.net</div>
                    <div class="mockup__table-cell">E-Wallet</div>
                    <div class="mockup__table-cell"><span class="mockup__pill mockup__pill--pending">Pending</span></div>
                  </div>
                  <div class="mockup__table-row">
                    <div class="mockup__table-cell">lazada-flash.co</div>
                    <div class="mockup__table-cell">E-Commerce</div>
                    <div class="mockup__table-cell"><span class="mockup__pill mockup__pill--new">New</span></div>
                  </div>
                  <div class="mockup__table-row">
                    <div class="mockup__table-cell">sss-benefits.xyz</div>
                    <div class="mockup__table-cell">Government</div>
                    <div class="mockup__table-cell"><span class="mockup__pill mockup__pill--verified">Verified</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
         CTA SECTION
    ============================================================ -->
    <section class="cta" aria-labelledby="cta-heading">
      <div class="cta__inner">
        <h2 class="cta__title" id="cta-heading">
          Help Build a Safer<br/>Digital Philippines
        </h2>
        <p class="cta__desc">
          Join thousands of Filipinos already protecting their communities 
          from phishing attacks. Registration is free and takes less than a minute.
        </p>
        <div class="cta__buttons">
          <button class="btn btn--white btn--lg" onclick="openModal('register')">
            Register for Free
          </button>
          <button class="btn btn--outline-white btn--lg" onclick="openModal('report')">
            Report Anonymously
          </button>
        </div>
      </div>
    </section>
  </main>

  <!-- ============================================================
       FOOTER
  ============================================================ -->
  <footer>
    <div class="footer__inner">
      <div class="footer__top">
        <div class="footer__brand">
          <div class="footer__brand-logo">
            <div class="footer__brand-icon" aria-hidden="true">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 2L3 6v4c0 4.418 3.013 8.548 7 9.5C17 18.548 17 14.418 17 10V6L10 2z" fill="white" opacity="0.9"/>
                <path d="M7 10l2 2 4-4" stroke="#1d4ed8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <span class="footer__brand-name">PhishGuard PH</span>
          </div>
          <p class="footer__brand-desc">
            A community-driven platform dedicated to protecting Filipino internet 
            users from phishing attacks and online fraud. Together, we build a 
            safer Philippine cyberspace.
          </p>
        </div>

        <div>
          <h3 class="footer__col-title">Platform</h3>
          <ul class="footer__links" role="list">
            <li><a href="#" class="footer__link">Report Phishing</a></li>
            <li><a href="#" class="footer__link">Threat Dashboard</a></li>
            <li><a href="#" class="footer__link">My Reports</a></li>
            <li><a href="#" class="footer__link">API Access</a></li>
          </ul>
        </div>

        <div>
          <h3 class="footer__col-title">Resources</h3>
          <ul class="footer__links" role="list">
            <li><a href="#" class="footer__link">Phishing Guide</a></li>
            <li><a href="#" class="footer__link">Safety Tips</a></li>
            <li><a href="#" class="footer__link">FAQ</a></li>
            <li><a href="#" class="footer__link">Blog</a></li>
          </ul>
        </div>

        <div>
          <h3 class="footer__col-title">About</h3>
          <ul class="footer__links" role="list">
            <li><a href="#" class="footer__link">About Us</a></li>
            <li><a href="#" class="footer__link">Contact</a></li>
            <li><a href="#" class="footer__link">Privacy Policy</a></li>
            <li><a href="#" class="footer__link">Terms of Use</a></li>
          </ul>
        </div>
      </div>

      <div class="footer__bottom">
        <p>© 2025 PhishGuard PH. All rights reserved. Built to protect Filipino internet users.</p>
        <nav class="footer__bottom-links" aria-label="Footer legal links">
          <a href="#" class="footer__bottom-link">Privacy</a>
          <a href="#" class="footer__bottom-link">Terms</a>
          <a href="#" class="footer__bottom-link">Cookies</a>
          <a href="#" class="footer__bottom-link">Sitemap</a>
        </nav>
      </div>
    </div>
  </footer>

  <!-- ============================================================
       LOGIN MODAL
  ============================================================ -->
  <div class="modal-overlay" id="login-modal" role="dialog" aria-modal="true" aria-labelledby="login-title" onclick="handleOverlayClick(event, 'login')">
    <div class="modal">
      <div class="modal__header">
        <h2 class="modal__title" id="login-title">Sign In to PhishGuard</h2>
        <button class="modal__close" onclick="closeModal('login')" aria-label="Close login modal">✕</button>
      </div>
      <div class="form-tabs" role="tablist">
        <button class="form-tab form-tab--active" role="tab" aria-selected="true">User Login</button>
        <button class="form-tab" role="tab" aria-selected="false" onclick="openModal('admin-login'); closeModal('login');">Admin Login</button>
      </div>
      <div class="form-group">
        <label class="form-label" for="login-email">Email Address</label>
        <input class="form-input" type="email" id="login-email" placeholder="you@example.com" autocomplete="email" />
      </div>
      <div class="form-group">
        <label class="form-label" for="login-pass">Password</label>
        <input class="form-input" type="password" id="login-pass" placeholder="••••••••" autocomplete="current-password" />
      </div>
      <button class="btn btn--primary btn--full btn--lg">Sign In</button>
      <div class="form-divider"><span>or</span></div>
      <p style="text-align:center; font-size: var(--font-size-sm); color: var(--color-gray-500);">
        Don't have an account? 
        <a href="#" style="color: var(--color-primary); font-weight: 600;" onclick="openModal('register'); closeModal('login'); return false;">Register free</a>
      </p>
    </div>
  </div>

  <!-- ============================================================
       REGISTER MODAL
  ============================================================ -->
  <div class="modal-overlay" id="register-modal" role="dialog" aria-modal="true" aria-labelledby="register-title" onclick="handleOverlayClick(event, 'register')">
    <div class="modal">
      <div class="modal__header">
        <h2 class="modal__title" id="register-title">Create Your Account</h2>
        <button class="modal__close" onclick="closeModal('register')" aria-label="Close register modal">✕</button>
      </div>
      <div class="form-group">
        <label class="form-label" for="reg-name">Full Name</label>
        <input class="form-input" type="text" id="reg-name" placeholder="Juan dela Cruz" autocomplete="name" />
      </div>
      <div class="form-group">
        <label class="form-label" for="reg-email">Email Address</label>
        <input class="form-input" type="email" id="reg-email" placeholder="you@example.com" autocomplete="email" />
      </div>
      <div class="form-group">
        <label class="form-label" for="reg-pass">Password</label>
        <input class="form-input" type="password" id="reg-pass" placeholder="At least 8 characters" autocomplete="new-password" />
      </div>
      <button class="btn btn--primary btn--full btn--lg">Create Account</button>
      <p style="margin-top: var(--space-4); text-align:center; font-size: var(--font-size-xs); color: var(--color-gray-400); line-height: 1.6;">
        By registering, you agree to our <a href="#" style="color: var(--color-primary);">Terms of Use</a> 
        and <a href="#" style="color: var(--color-primary);">Privacy Policy</a>.
      </p>
      <div class="form-divider"><span>already have an account?</span></div>
      <button class="btn btn--outline btn--full" onclick="openModal('login'); closeModal('register');">Sign In</button>
    </div>
  </div>

  <!-- ============================================================
       REPORT MODAL
  ============================================================ -->
  <div class="modal-overlay" id="report-modal" role="dialog" aria-modal="true" aria-labelledby="report-modal-title" onclick="handleOverlayClick(event, 'report')">
    <div class="modal">
      <div class="modal__header">
        <h2 class="modal__title" id="report-modal-title">Report a Phishing Incident</h2>
        <button class="modal__close" onclick="closeModal('report')" aria-label="Close report modal">✕</button>
      </div>
      <div class="form-group">
        <label class="form-label" for="report-url">Suspicious URL <span style="color: var(--color-danger);">*</span></label>
        <input class="form-input" type="url" id="report-url" placeholder="https://suspicious-site.com" />
      </div>
      <div class="form-group">
        <label class="form-label" for="report-type">Phishing Type <span style="color: var(--color-danger);">*</span></label>
        <select class="form-select" id="report-type">
          <option value="">Select category...</option>
          <option>Banking / Finance</option>
          <option>Government Services</option>
          <option>E-Commerce</option>
          <option>E-Wallet (GCash, Maya)</option>
          <option>Social Media</option>
          <option>Email / SMS</option>
          <option>Other</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label" for="report-desc">Description</label>
        <textarea class="form-textarea" id="report-desc" placeholder="Describe what happened and how you encountered this phishing site..."></textarea>
      </div>
      <button class="btn btn--danger btn--full btn--lg">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
        </svg>
        Submit Report
      </button>
      <p style="margin-top: var(--space-3); text-align:center; font-size: var(--font-size-xs); color: var(--color-gray-400);">
        This report will be reviewed by our team within 24 hours.
      </p>
    </div>
  </div>

  <!-- ============================================================
       ADMIN LOGIN MODAL
  ============================================================ -->
  <div class="modal-overlay" id="admin-login-modal" role="dialog" aria-modal="true" aria-labelledby="admin-login-title" onclick="handleOverlayClick(event, 'admin-login')">
    <div class="modal">
      <div class="modal__header">
        <h2 class="modal__title" id="admin-login-title">Admin Portal</h2>
        <button class="modal__close" onclick="closeModal('admin-login')" aria-label="Close admin login modal">✕</button>
      </div>
      <div style="background: var(--color-warning-bg); border: 1px solid #fde68a; border-radius: var(--radius-md); padding: var(--space-3) var(--space-4); margin-bottom: var(--space-5); display: flex; align-items: center; gap: var(--space-2);">
        <span style="font-size: var(--font-size-base);">🔐</span>
        <span style="font-size: var(--font-size-sm); color: var(--color-warning);">Restricted access — authorized personnel only</span>
      </div>
      <div class="form-group">
        <label class="form-label" for="admin-email">Admin Email</label>
        <input class="form-input" type="email" id="admin-email" placeholder="admin@phishguard.ph" autocomplete="email" />
      </div>
      <div class="form-group">
        <label class="form-label" for="admin-pass">Admin Password</label>
        <input class="form-input" type="password" id="admin-pass" placeholder="••••••••" autocomplete="current-password" />
      </div>
      <button class="btn btn--primary btn--full btn--lg">Access Admin Panel</button>
      <div class="form-divider"><span>not an admin?</span></div>
      <button class="btn btn--ghost btn--full" onclick="openModal('login'); closeModal('admin-login');">Return to User Login</button>
    </div>
  </div>

  <script>
    // ============================================================
    // MOBILE MENU TOGGLE
    // ============================================================
    function toggleMobileMenu() {
      const btn  = document.getElementById('hamburger-btn');
      const menu = document.getElementById('mobile-menu');
      const isOpen = btn.getAttribute('aria-expanded') === 'true';

      btn.setAttribute('aria-expanded', String(!isOpen));
      if (!isOpen) {
        menu.classList.add('navbar__mobile-menu--open');
      } else {
        menu.classList.remove('navbar__mobile-menu--open');
      }
    }

    // Close mobile menu when a mobile link is clicked
    document.querySelectorAll('.navbar__mobile-link').forEach(function(link) {
      link.addEventListener('click', function() {
        const btn  = document.getElementById('hamburger-btn');
        const menu = document.getElementById('mobile-menu');
        btn.setAttribute('aria-expanded', 'false');
        menu.classList.remove('navbar__mobile-menu--open');
      });
    });

    // ============================================================
    // MODAL SYSTEM
    // ============================================================
    function openModal(name) {
      var overlay = document.getElementById(name + '-modal');
      if (overlay) {
        overlay.classList.add('modal-overlay--open');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeModal(name) {
      var overlay = document.getElementById(name + '-modal');
      if (overlay) {
        overlay.classList.remove('modal-overlay--open');
        document.body.style.overflow = '';
      }
    }

    function handleOverlayClick(event, name) {
      if (event.target === event.currentTarget) {
        closeModal(name);
      }
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        ['login', 'register', 'report', 'admin-login'].forEach(function(name) {
          closeModal(name);
        });
      }
    });

    // ============================================================
    // SMOOTH SCROLL + ACTIVE NAV
    // ============================================================
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
      anchor.addEventListener('click', function(e) {
        var target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  </script>
</body>
</html>
