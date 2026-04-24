<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard &mdash; Blog personnel</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23A855F7'/><stop offset='1' stop-color='%23EC4899'/></linearGradient></defs><rect width='32' height='32' rx='8' fill='url(%23g)'/><text x='16' y='22' text-anchor='middle' font-family='sans-serif' font-weight='700' font-size='18' fill='white'>A</text></svg>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

  <style>
    /* ─── Reset ─── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:      #A855F7;
      --accent-rose: #EC4899;
      --accent-cyan: #06B6D4;
      --text-1: #F5F5FA;
      --text-2: #9CA3AF;
      --text-3: #6B7280;
      --green:  #10F5A0;
      --amber:  #FBBF24;
      --red:    #EF4444;
      --bg:     #0A0118;
      --glass:  rgba(255,255,255,0.055);
      --border: rgba(255,255,255,0.09);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text-1);
      background: var(--bg);
      background-image:
        radial-gradient(ellipse 75% 55% at 80% 0%,   #1A0B2E 0%, transparent 65%),
        radial-gradient(ellipse 55% 45% at 5%  90%,  #0D0D1F 0%, transparent 55%),
        radial-gradient(ellipse 100% 100% at 50% 50%, #0A0118 0%, #0D0D1F 100%);
      min-height: 100vh;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
    }

    /* ─── Dot grid overlay ─── */
    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,0.025) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none;
      z-index: 0;
      animation: gridFadeIn 1.2s ease both;
    }
    @keyframes gridFadeIn { from { opacity: 0; } to { opacity: 1; } }

    /* ─── Orbs ─── */
    .orb {
      position: fixed; border-radius: 50%;
      pointer-events: none; z-index: 0;
      filter: blur(120px);
    }
    .orb-1 { width: 640px; height: 640px; background: #A855F7; top: -160px; left: -130px; opacity: 0.28; animation: o1 22s ease-in-out infinite; }
    .orb-2 { width: 460px; height: 460px; background: #EC4899; bottom: -90px; right:  -90px; opacity: 0.20; animation: o2 18s ease-in-out infinite; }
    .orb-3 { width: 380px; height: 380px; background: #06B6D4; top: 42%;   left:   54%; opacity: 0.13; animation: o3 26s ease-in-out infinite; }

    @keyframes o1 { 0%,100%{transform:translate(0,0)}  40%{transform:translate(38px,-48px)}  70%{transform:translate(-20px,30px)} }
    @keyframes o2 { 0%,100%{transform:translate(0,0)}  35%{transform:translate(-32px,-24px)}  65%{transform:translate(22px,20px)} }
    @keyframes o3 { 0%,100%{transform:translate(0,0)}  50%{transform:translate(48px,-32px)} }

    /* ─── Cursor glow ─── */
    #cg {
      position: fixed; width: 340px; height: 340px; border-radius: 50%;
      background: radial-gradient(circle, rgba(168,85,247,0.08) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
      transform: translate(-50%,-50%);
      transition: left 0.12s ease, top 0.12s ease;
    }

    /* ─── Glass card ─── */
    .glass {
      background: var(--glass);
      backdrop-filter: blur(28px);
      -webkit-backdrop-filter: blur(28px);
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.07), 0 4px 32px rgba(0,0,0,0.25);
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .glass:hover {
      border-color: rgba(168,85,247,0.18);
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.09), 0 8px 40px rgba(168,85,247,0.08);
    }

    /* ─── Navbar ─── */
    .navbar {
      position: sticky; top: 0; z-index: 100;
      background: rgba(10,1,24,0.8);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
      padding: 0 40px; height: 66px;
      display: flex; align-items: center; justify-content: space-between;
      flex-shrink: 0;
      animation: slideDown 0.5s cubic-bezier(0.4,0,0.2,1) both;
    }
    @keyframes slideDown { from { transform: translateY(-100%); opacity: 0; } to { transform: none; opacity: 1; } }

    .logo-box {
      width: 38px; height: 38px;
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 18px; color: #fff;
      flex-shrink: 0;
      box-shadow: 0 0 20px rgba(168,85,247,0.35);
    }
    .logo-text { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 17px; color: var(--text-1); }
    .logo-text span { color: var(--accent); }

    .nav-pill {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(168,85,247,0.12);
      border: 1px solid rgba(168,85,247,0.25);
      border-radius: 20px; padding: 6px 14px;
      font-size: 13px; font-weight: 500; color: #C084FC;
      text-decoration: none;
      transition: all 0.25s ease;
    }
    .nav-pill:hover { background: rgba(168,85,247,0.22); box-shadow: 0 0 16px rgba(168,85,247,0.25); }

    .btn-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.1);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: var(--text-2);
      transition: all 0.25s ease; text-decoration: none;
    }
    .btn-icon:hover { border-color: rgba(168,85,247,0.5); color: #C084FC; box-shadow: 0 0 12px rgba(168,85,247,0.25); }

    /* ─── Layout ─── */
    .page {
      position: relative; z-index: 1;
      max-width: 1300px; margin: 0 auto;
      padding: 44px 40px 100px;
      width: 100%; flex: 1;
    }

    /* ─── Buttons ─── */
    .btn-primary {
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      border: none; border-radius: 12px; padding: 0 24px; height: 48px;
      font-family: 'Inter', sans-serif; font-weight: 600; font-size: 15px; color: #fff;
      cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
      transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
      text-decoration: none; white-space: nowrap;
      box-shadow: 0 0 0 rgba(168,85,247,0);
    }
    .btn-primary:hover {
      transform: translateY(-2px) scale(1.02);
      box-shadow: 0 8px 32px rgba(168,85,247,0.5);
    }
    .btn-primary:active { transform: scale(0.98); }

    .btn-ghost {
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px; padding: 12px 24px;
      font-family: 'Inter', sans-serif; font-weight: 500; font-size: 14px; color: var(--text-2);
      cursor: pointer; transition: all 0.3s ease;
    }
    .btn-ghost:hover { border-color: rgba(255,255,255,0.2); color: var(--text-1); }

    .btn-danger {
      background: linear-gradient(135deg, #EF4444, #DC2626);
      border: none; border-radius: 12px; padding: 12px 24px;
      font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; color: #fff;
      cursor: pointer; transition: all 0.3s ease;
    }
    .btn-danger:hover { box-shadow: 0 0 28px rgba(239,68,68,0.5); transform: scale(1.02); }

    /* ─── Separator ─── */
    .sep-line {
      height: 1px;
      background: linear-gradient(90deg, rgba(168,85,247,0.6), rgba(236,72,153,0.3), transparent);
      margin: 32px 0; border: none;
    }

    /* ─── Page header ─── */
    .page-header {
      display: flex; align-items: flex-start; justify-content: space-between;
      gap: 20px; flex-wrap: wrap; margin-bottom: 8px;
    }
    .page-header h1 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(28px, 3.5vw, 38px);
      font-weight: 700; letter-spacing: -0.025em; color: var(--text-1);
      margin-bottom: 6px;
    }
    .page-header h1 .wave {
      display: inline-block;
      animation: wave 2.4s ease-in-out infinite;
      transform-origin: 70% 70%;
    }
    @keyframes wave {
      0%,60%,100% { transform: rotate(0deg); }
      10%,30%     { transform: rotate(18deg); }
      20%          { transform: rotate(-8deg); }
      40%          { transform: rotate(14deg); }
      50%          { transform: rotate(-4deg); }
    }
    .page-header p { font-size: 15px; color: var(--text-2); }

    /* ─── Stats grid ─── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px; margin-bottom: 32px;
    }

    .stat-card {
      padding: 26px 24px; position: relative; overflow: hidden;
      border-radius: 18px; cursor: default;
    }
    .stat-card::before {
      content: '';
      position: absolute; inset: 0; border-radius: 18px;
      opacity: 0; transition: opacity 0.4s ease;
      background: radial-gradient(ellipse at 50% 120%, rgba(168,85,247,0.12), transparent 70%);
    }
    .stat-card:hover::before { opacity: 1; }
    .stat-card:hover { transform: translateY(-3px); }

    .stat-icon-wrap {
      width: 50px; height: 50px; border-radius: 13px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 18px;
    }
    .stat-label {
      font-family: 'JetBrains Mono', monospace;
      font-size: 10.5px; color: var(--text-3);
      text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px;
    }
    .stat-value {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 46px; font-weight: 700;
      letter-spacing: -0.04em; line-height: 1;
      margin-bottom: 12px;
    }
    .stat-delta { font-size: 12px; display: flex; align-items: center; gap: 5px; }

    /* ─── Divider with label ─── */
    .section-label {
      display: flex; align-items: center; gap: 12px;
      margin-bottom: 16px;
    }
    .section-label h2 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 18px; font-weight: 700; white-space: nowrap;
    }
    .section-label::after {
      content: '';
      flex: 1; height: 1px;
      background: linear-gradient(90deg, rgba(255,255,255,0.08), transparent);
    }

    /* ─── Action bar ─── */
    .action-bar {
      display: flex; align-items: center; gap: 12px;
      margin-bottom: 16px; flex-wrap: wrap;
    }
    .search-wrap { position: relative; flex: 1; min-width: 200px; max-width: 340px; }
    .search-icon {
      position: absolute; left: 14px; top: 50%;
      transform: translateY(-50%); color: var(--text-3); pointer-events: none;
    }
    .search-wrap input {
      width: 100%;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px; padding: 11px 16px 11px 42px;
      font-family: 'Inter', sans-serif; font-size: 14px; color: var(--text-1);
      outline: none; transition: all 0.3s ease;
    }
    .search-wrap input::placeholder { color: var(--text-3); }
    .search-wrap input:focus {
      border-color: rgba(168,85,247,0.55);
      box-shadow: 0 0 0 3px rgba(168,85,247,0.1);
    }

    .filter-pill {
      padding: 9px 18px; border-radius: 20px;
      font-size: 13px; font-weight: 500; cursor: pointer;
      border: 1px solid rgba(255,255,255,0.1);
      background: rgba(255,255,255,0.05); color: var(--text-2);
      transition: all 0.25s ease; user-select: none;
    }
    .filter-pill:hover { border-color: rgba(168,85,247,0.4); color: var(--text-1); }
    .filter-pill.active {
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      border-color: transparent; color: #fff; font-weight: 600;
      box-shadow: 0 0 20px rgba(168,85,247,0.4);
    }

    .view-toggle {
      display: flex;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 10px; overflow: hidden;
    }
    .view-btn {
      width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: var(--text-3); transition: all 0.2s ease;
    }
    .view-btn.active { background: rgba(168,85,247,0.2); color: #C084FC; }
    .view-btn:hover { color: var(--text-2); }

    /* ─── Table ─── */
    .table-wrap { padding: 0; overflow: hidden; border-radius: 18px; }

    .table-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 22px 26px 18px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .table-title { font-family: 'Space Grotesk', sans-serif; font-size: 18px; font-weight: 600; }
    .article-count {
      font-family: 'JetBrains Mono', monospace; font-size: 11px; color: var(--text-3);
      background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
      border-radius: 20px; padding: 4px 12px;
    }

    table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    thead tr { background: rgba(255,255,255,0.02); }
    thead th {
      text-align: left; padding: 12px 16px;
      font-family: 'JetBrains Mono', monospace; font-size: 10.5px;
      color: var(--text-3); text-transform: uppercase; letter-spacing: 0.1em;
      font-weight: 500; white-space: nowrap; overflow: hidden;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    thead th:last-child, tbody td:last-child { text-align: right; }
    tbody tr {
      border-bottom: 1px solid rgba(255,255,255,0.04);
      transition: background 0.2s ease;
      cursor: pointer;
    }
    tbody tr:hover { background: rgba(168,85,247,0.05); }
    tbody tr:hover td:first-child { border-left: 3px solid var(--accent); padding-left: 13px; }
    tbody td {
      padding: 16px 16px; font-size: 14px; color: var(--text-2);
      vertical-align: middle; overflow: hidden;
    }
    tbody td:first-child { border-left: 3px solid transparent; transition: border-color 0.2s ease, padding-left 0.2s ease; }
    tbody tr:last-child { border-bottom: none; }

    .title-cell { display: flex; align-items: center; gap: 10px; }
    .title-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
    .article-name {
      font-weight: 500; color: var(--text-1); font-size: 14px;
      overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }

    /* ─── Category badge ─── */
    .cat-badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 10px; border-radius: 12px;
      font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 500; white-space: nowrap;
    }
    .cat-laravel { background: rgba(239,68,68,0.1);   border: 1px solid rgba(239,68,68,0.25);   color: #FCA5A5; }
    .cat-js      { background: rgba(251,191,36,0.1);  border: 1px solid rgba(251,191,36,0.3);   color: #FBBF24; }
    .cat-devops  { background: rgba(6,182,212,0.1);   border: 1px solid rgba(6,182,212,0.3);    color: #22D3EE; }
    .cat-career  { background: rgba(168,85,247,0.1);  border: 1px solid rgba(168,85,247,0.3);   color: #C084FC; }

    /* ─── Status badge ─── */
    .status-badge {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 4px 12px; border-radius: 20px;
      font-size: 12px; font-weight: 500; white-space: nowrap;
    }
    .status-published { background: rgba(16,245,160,0.1); border: 1px solid rgba(16,245,160,0.3); color: var(--green); }
    .status-draft     { background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.3); color: var(--amber); }
    .status-dot { width: 6px; height: 6px; border-radius: 50%; }
    .status-published .status-dot { background: var(--green); box-shadow: 0 0 7px var(--green); animation: blink 2s ease-in-out infinite; }
    .status-draft     .status-dot { background: var(--amber); box-shadow: 0 0 7px var(--amber); }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.4} }

    /* ─── Sparkline ─── */
    .sparkline { display: flex; align-items: flex-end; gap: 2px; height: 18px; }
    .spark-bar { width: 4px; border-radius: 2px; background: rgba(168,85,247,0.45); transition: background 0.2s ease; }
    tbody tr:hover .spark-bar { background: rgba(168,85,247,0.85); }

    /* ─── Row actions ─── */
    .actions { display: flex; align-items: center; gap: 5px; justify-content: flex-end; }
    .act-btn {
      width: 30px; height: 30px; border-radius: 8px;
      background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
      display: inline-flex; align-items: center; justify-content: center;
      cursor: pointer; transition: all 0.2s ease; color: var(--text-3);
      text-decoration: none;
    }
    .act-view:hover { color: #22D3EE; border-color: rgba(6,182,212,0.5);  box-shadow: 0 0 10px rgba(6,182,212,0.3); background: rgba(6,182,212,0.08); }
    .act-edit:hover { color: #C084FC;  border-color: rgba(168,85,247,0.5); box-shadow: 0 0 10px rgba(168,85,247,0.3); background: rgba(168,85,247,0.08); }
    .act-del:hover  { color: #FCA5A5; border-color: rgba(239,68,68,0.5);  box-shadow: 0 0 10px rgba(239,68,68,0.3); background: rgba(239,68,68,0.08); }

    /* ─── Bottom grid ─── */
    .bottom-grid {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 20px; margin-top: 24px;
    }

    /* ─── Timeline ─── */
    .timeline { padding: 24px 26px; }
    .timeline-item {
      display: flex; gap: 16px; position: relative; padding-bottom: 26px;
    }
    .timeline-item:not(:last-child)::after {
      content: '';
      position: absolute; left: 11px; top: 24px; bottom: 0;
      width: 1px; background: rgba(255,255,255,0.07);
    }
    .timeline-dot {
      width: 24px; height: 24px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; margin-top: 1px;
    }
    .timeline-content { flex: 1; min-width: 0; }
    .timeline-title { font-size: 14px; color: var(--text-1); margin-bottom: 4px; font-weight: 500; line-height: 1.45; }
    .timeline-time  { font-family: 'JetBrains Mono', monospace; font-size: 11.5px; color: var(--text-3); }

    /* ─── Quick actions ─── */
    .quick-btn {
      width: 100%; height: 44px;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px; color: var(--text-2);
      font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 500;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      gap: 8px; transition: all 0.25s ease; text-decoration: none;
    }
    .quick-btn:hover { border-color: rgba(6,182,212,0.45); color: #22D3EE; }
    .quick-btn.warn:hover { border-color: rgba(251,191,36,0.45); color: var(--amber); }

    /* ─── Mini stats inside quick card ─── */
    .mini-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .mini-stat {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.07);
      border-radius: 10px; padding: 14px; text-align: center;
    }
    .mini-stat-val { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 700; }
    .mini-stat-lbl { font-family: 'JetBrains Mono', monospace; font-size: 9.5px; color: var(--text-3); margin-top: 3px; }

    /* ─── Delete modal ─── */
    .modal-overlay {
      position: fixed; inset: 0; z-index: 999;
      background: rgba(0,0,0,0.65); backdrop-filter: blur(8px);
      display: flex; align-items: center; justify-content: center;
      opacity: 0; pointer-events: none;
      transition: opacity 0.3s ease;
      padding: 20px;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal-card {
      background: rgba(12,4,28,0.97);
      border: 1px solid rgba(239,68,68,0.3);
      border-radius: 22px; padding: 40px;
      max-width: 440px; width: 100%;
      box-shadow: 0 0 80px rgba(239,68,68,0.18);
      transform: scale(0.94) translateY(20px);
      transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
    }
    .modal-overlay.open .modal-card { transform: scale(1) translateY(0); }

    /* ─── Scroll reveal ─── */
    .reveal {
      opacity: 0;
      transform: translateY(22px);
      transition: opacity 0.55s ease, transform 0.55s ease;
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* ─── Empty state ─── */
    .empty-state { display: none; padding: 80px 40px; text-align: center; }

    /* ─── Tweaks panel ─── */
    #tweakPanel {
      display: none; position: fixed; bottom: 24px; right: 24px; z-index: 9999;
    }
    #tweakPanel .glass { padding: 22px; min-width: 240px; border-radius: 18px; }

    /* ─── Responsive ─── */
    @media (max-width: 1100px) {
      .bottom-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 1024px) {
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
      .page { padding: 28px 20px 60px; }
      .navbar { padding: 0 20px; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
      .table-wrap-scroll { overflow-x: auto; }
      table { min-width: 700px; }
      .col-views { display: none; }
    }
    @media (max-width: 480px) {
      .stats-grid { grid-template-columns: 1fr 1fr; }
    }
  </style>
</head>
<body>

  <div id="cg"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

  <!-- ══════════ NAVBAR ══════════ -->
  <header class="navbar">
    <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
      <div class="logo-box">B</div>
      <span class="logo-text">Blog<span> personnel</span></span>
    </a>
    <div style="display:flex;align-items:center;gap:10px;">
      <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">Dashboard</span>
      <a href="{{ route('welcome') }}" class="nav-pill">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
        Blog public
      </a>
      <form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="btn-icon" title="D&eacute;connexion">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/></svg>
        </button>
      </form>
    </div>
  </header>

  <!-- ══════════ PAGE ══════════ -->
  <main class="page">

    <!-- ── Header ── -->
    <div class="page-header reveal">
      <div>
        <h1><span class="wave">&#128075;</span> Salut {{ auth()->user()->name }}</h1>
        <p>Voici l&rsquo;&eacute;tat de ton blog aujourd&rsquo;hui &middot;
          <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">{{ now()->translatedFormat('d F Y') }}</span>
        </p>
      </div>
      <a href="{{ route('articles.create') }}" class="btn-primary">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M12 5v14M5 12h14"/></svg>
        Nouvel article
      </a>
    </div>

    <hr class="sep-line" />

    <!-- ── Stats grid ── -->
    <div class="stats-grid">

      <!-- Total -->
      <div class="glass stat-card reveal">
        <div class="stat-icon-wrap" style="background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.25);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#A855F7" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        </div>
        <div class="stat-label">Total articles</div>
        <div class="stat-value" style="background:linear-gradient(135deg,#A855F7,#EC4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
          {{ $totalArticles }}
        </div>
        <div class="stat-delta" style="color:var(--green);">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 15l-6-6-6 6"/></svg>
          +2 cette semaine
        </div>
      </div>

      <!-- Publi&eacute;s -->
      <div class="glass stat-card reveal" style="transition-delay:0.07s;">
        <div class="stat-icon-wrap" style="background:rgba(16,245,160,0.1);border:1px solid rgba(16,245,160,0.2);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#10F5A0" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-label">Publi&eacute;s</div>
        <div class="stat-value" style="color:#10F5A0;">{{ $publishedCount }}</div>
        <div class="stat-delta" style="color:var(--text-3);">
          <span style="width:7px;height:7px;background:#10F5A0;border-radius:50%;box-shadow:0 0 7px #10F5A0;display:inline-block;animation:blink 2s ease-in-out infinite;"></span>
          Visibles publiquement
        </div>
      </div>

      <!-- Brouillons -->
      <div class="glass stat-card reveal" style="transition-delay:0.14s;">
        <div class="stat-icon-wrap" style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#FBBF24" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <div class="stat-label">Brouillons</div>
        <div class="stat-value" style="color:#FBBF24;">{{ $draftCount }}</div>
        <div class="stat-delta" style="color:var(--text-3);">
          <span style="width:7px;height:7px;background:#FBBF24;border-radius:50%;box-shadow:0 0 7px #FBBF24;display:inline-block;"></span>
          En cours d&rsquo;&eacute;criture
        </div>
      </div>

      <!-- Vues -->
      <div class="glass stat-card reveal" style="transition-delay:0.21s;">
        <div class="stat-icon-wrap" style="background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.2);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#06B6D4" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <div class="stat-label">Vues totales</div>
        <div class="stat-value" style="color:#06B6D4;">{{ number_format($totalViews) }}</div>
        <div class="stat-delta" style="color:var(--green);">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 15l-6-6-6 6"/></svg>
          +34% cette semaine
        </div>
      </div>
    </div>

    <!-- ── Action bar ── -->
    <div class="section-label reveal">
      <h2>Tes articles</h2>
    </div>

    <div class="action-bar reveal">
      <div class="search-wrap">
        <span class="search-icon">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        </span>
        <input type="text" placeholder="Rechercher un article&hellip;" oninput="filterRows(this.value)" />
      </div>
      <span class="filter-pill active" onclick="setStatusFilter(this,'all')">Tous</span>
      <span class="filter-pill" onclick="setStatusFilter(this,'publie')">Publi&eacute;s</span>
      <span class="filter-pill" onclick="setStatusFilter(this,'brouillon')">Brouillons</span>
      <div style="margin-left:auto;">
        <div class="view-toggle">
          <div class="view-btn active" title="Vue liste">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
          </div>
          <div class="view-btn" title="Vue grille">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Table ── -->
    <div class="glass table-wrap reveal" id="tableWrap">
      <div class="table-header">
        <span class="table-title">Articles</span>
        <span class="article-count" id="articleCount">{{ $totalArticles }} article{{ $totalArticles > 1 ? 's' : '' }}</span>
      </div>
      <div style="overflow-x:auto;">
        <table id="articlesTable">
          <colgroup>
            <col style="width:34%;">
            <col style="width:16%;">
            <col style="width:15%;">
            <col style="width:13%;">
            <col class="col-views" style="width:12%;">
            <col style="width:10%;">
          </colgroup>
          <thead>
            <tr>
              <th>TITRE</th>
              <th>CAT&Eacute;GORIE</th>
              <th>STATUT</th>
              <th>CR&Eacute;&Eacute; LE</th>
              <th class="col-views">VUES</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody id="tableBody">

            @forelse($articles ?? [] as $article)
            @php /** @var \App\Models\Article $article */ @endphp
            <tr data-status="{{ $article->statut }}" data-title="{{ strtolower($article->titre) }}">
              <td>
                <div class="title-cell">
                  <span class="title-dot" style="background:{{ $article->statut === 'publie' ? '#FCA5A5' : '#FBBF24' }};box-shadow:0 0 7px {{ $article->statut === 'publie' ? 'rgba(252,165,165,0.5)' : 'rgba(251,191,36,0.5)' }};"></span>
                  <span class="article-name">{{ $article->titre }}</span>
                </div>
              </td>
              <td>
                @if($article->category)
                  @php
                    $cat = strtolower($article->category->nom ?? '');
                    $catClass = str_contains($cat,'laravel') ? 'cat-laravel' : (str_contains($cat,'javascript') || str_contains($cat,'js') ? 'cat-js' : (str_contains($cat,'devops') ? 'cat-devops' : 'cat-career'));
                    $catIcon  = str_contains($cat,'laravel') ? '&#9889;' : (str_contains($cat,'javascript') || str_contains($cat,'js') ? '&#9670;' : (str_contains($cat,'devops') ? '&#9650;' : '&#9733;'));
                  @endphp
                  <span class="cat-badge {{ $catClass }}">{!! $catIcon !!} {{ $article->category->nom }}</span>
                @else
                  <span class="cat-badge cat-laravel">&#9889; G&eacute;n&eacute;ral</span>
                @endif
              </td>
              <td>
                @if($article->statut === 'publie')
                  <span class="status-badge status-published"><span class="status-dot"></span>Publi&eacute;</span>
                @else
                  <span class="status-badge status-draft"><span class="status-dot"></span>Brouillon</span>
                @endif
              </td>
              <td style="white-space:nowrap;"><span style="font-family:'JetBrains Mono',monospace;font-size:12px;">{{ $article->created_at->format('d M Y') }}</span></td>
              <td class="col-views">
                <div style="display:flex;align-items:center;gap:10px;">
                  @if($article->statut === 'publie' && $article->views)
                    <span style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-1);min-width:38px;">{{ $article->views }}</span>
                    <div class="sparkline">
                      <div class="spark-bar" style="height:7px;"></div>
                      <div class="spark-bar" style="height:11px;"></div>
                      <div class="spark-bar" style="height:9px;"></div>
                      <div class="spark-bar" style="height:15px;"></div>
                      <div class="spark-bar" style="height:13px;"></div>
                      <div class="spark-bar" style="height:18px;background:rgba(168,85,247,0.9);"></div>
                    </div>
                  @else
                    <span style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-3);">&mdash;</span>
                  @endif
                </div>
              </td>
              <td>
                <div class="actions">
                  @if($article->statut === 'publie')
                    <a href="{{ route('welcome') }}" class="act-btn act-view" title="Voir l'article">
                      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </a>
                  @else
                    <button class="act-btn act-view" title="Brouillon" style="opacity:0.35;cursor:not-allowed;" disabled>
                      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                  @endif
                  <a href="{{ route('articles.edit', $article->id) }}" class="act-btn act-edit" title="&Eacute;diter">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </a>
                  <button class="act-btn act-del" title="Supprimer" onclick="openDeleteModal('{{ addslashes($article->titre) }}', {{ $article->id }})">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                  </button>
                </div>
              </td>
            </tr>
            @empty
            @php
              $demoRows = [
                ['title'=>'Apprendre Laravel en 2026 : Le Guide Complet','cat'=>'cat-laravel','catLabel'=>'&#9889; Laravel','status'=>'publie','date'=>'23 avr. 2026','views'=>432,'dot'=>'#FCA5A5','id'=>1],
                ['title'=>'Les Nouveautés de PHP 8.4','cat'=>'cat-js','catLabel'=>'&#9670; PHP','status'=>'publie','date'=>'23 avr. 2026','views'=>287,'dot'=>'#FBBF24','id'=>2],
                ['title'=>'Sécuriser son Application Web : Les Bonnes Pratiques','cat'=>'cat-career','catLabel'=>'&#9733; Securite','status'=>'publie','date'=>'23 avr. 2026','views'=>318,'dot'=>'#FCA5A5','id'=>3],
                ['title'=>'Tendances Web Design 2026 : Minimalisme et Animations','cat'=>'cat-devops','catLabel'=>'&#9650; Web Design','status'=>'brouillon','date'=>'23 avr. 2026','views'=>null,'dot'=>'#FBBF24','id'=>4],
                ['title'=>'Maîtriser Eloquent ORM : Relations et Requêtes Avancées','cat'=>'cat-laravel','catLabel'=>'&#9889; Laravel','status'=>'publie','date'=>'23 avr. 2026','views'=>197,'dot'=>'#FCA5A5','id'=>5],
                ['title'=>'Créer une API REST avec Laravel et Sanctum','cat'=>'cat-js','catLabel'=>'&#9670; PHP','status'=>'brouillon','date'=>'23 avr. 2026','views'=>null,'dot'=>'#FBBF24','id'=>6],
              ];
            @endphp
            @foreach($demoRows as $row)
            <tr data-status="{{ $row['status'] }}" data-title="{{ strtolower($row['title']) }}">
              <td>
                <div class="title-cell">
                  <span class="title-dot" style="background:{{ $row['dot'] }};box-shadow:0 0 7px {{ $row['dot'] }}44;"></span>
                  <span class="article-name">{{ $row['title'] }}</span>
                </div>
              </td>
              <td><span class="cat-badge {{ $row['cat'] }}">{!! $row['catLabel'] !!}</span></td>
              <td>
                @if($row['status'] === 'publie')
                  <span class="status-badge status-published"><span class="status-dot"></span>Publi&eacute;</span>
                @else
                  <span class="status-badge status-draft"><span class="status-dot"></span>Brouillon</span>
                @endif
              </td>
              <td style="white-space:nowrap;"><span style="font-family:'JetBrains Mono',monospace;font-size:12px;">{{ $row['date'] }}</span></td>
              <td class="col-views">
                @if($row['views'])
                  <div style="display:flex;align-items:center;gap:8px;">
                    <span style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-1);">{{ $row['views'] }}</span>
                    <div class="sparkline">
                      <div class="spark-bar" style="height:6px;"></div><div class="spark-bar" style="height:10px;"></div>
                      <div class="spark-bar" style="height:8px;"></div><div class="spark-bar" style="height:14px;"></div>
                      <div class="spark-bar" style="height:12px;background:rgba(168,85,247,0.9);"></div>
                    </div>
                  </div>
                @else
                  <span style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-3);">&mdash;</span>
                @endif
              </td>
              <td>
                <div class="actions">
                  @if($row['status'] === 'publie')
                    <button class="act-btn act-view" title="Voir">
                      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                  @else
                    <button class="act-btn act-view" title="Brouillon" style="opacity:0.3;cursor:not-allowed;" disabled>
                      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                  @endif
                  <button class="act-btn act-edit" title="&Eacute;diter">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </button>
                  <button class="act-btn act-del" title="Supprimer" onclick="openDeleteModal('{{ addslashes($row['title']) }}', {{ $row['id'] }})">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                  </button>
                </div>
              </td>
            </tr>
            @endforeach
            @endforelse

          </tbody>
        </table>
      </div>

      <!-- Empty search state -->
      <div class="empty-state" id="emptyState">
        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" style="margin:0 auto 20px;">
          <circle cx="40" cy="40" r="40" fill="rgba(168,85,247,0.08)"/>
          <circle cx="40" cy="40" r="28" fill="rgba(168,85,247,0.06)" stroke="rgba(168,85,247,0.2)" stroke-width="1"/>
          <path d="M28 42l8 8 16-18" stroke="rgba(168,85,247,0.4)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-3);">Aucun article trouv&eacute;</p>
      </div>
    </div>

    <!-- ── Bottom grid ── -->
    <div class="bottom-grid" id="bottomGrid">

      <!-- Activity feed -->
      <div class="glass reveal" style="padding:0;overflow:hidden;">
        <div style="padding:22px 26px 16px;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:space-between;">
          <span style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:600;">Activit&eacute; r&eacute;cente</span>
          <span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--text-3);">// LOGS</span>
        </div>
        <div class="timeline">

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(16,245,160,0.12);border:1px solid rgba(16,245,160,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#10F5A0" stroke-width="2.5"><path d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Article publi&eacute; : <span style="color:#C084FC;">Les relations Eloquent&hellip;</span></div>
              <div class="timeline-time">il y a 2h</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#FBBF24" stroke-width="2.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Brouillon modifi&eacute; : <span style="color:#FBBF24;">Queues &amp; Jobs Laravel&hellip;</span></div>
              <div class="timeline-time">hier, 22:14</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(6,182,212,0.12);border:1px solid rgba(6,182,212,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#06B6D4" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Pic de trafic : <span style="color:#06B6D4;">+89 vues en 1h</span></div>
              <div class="timeline-time">avant-hier, 15:30</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#A855F7" stroke-width="2.5"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Connexion depuis <span style="color:#A855F7;">Agadir, MA</span></div>
              <div class="timeline-time">il y a 2 jours &middot; Safari / macOS</div>
            </div>
          </div>

          <div class="timeline-item" style="padding-bottom:0;">
            <div class="timeline-dot" style="background:rgba(252,165,165,0.12);border:1px solid rgba(252,165,165,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#FCA5A5" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Article publi&eacute; : <span style="color:#FCA5A5;">Prot&eacute;ger ses routes&hellip;</span></div>
              <div class="timeline-time">il y a 5 jours</div>
            </div>
          </div>

        </div>
      </div>

      <!-- Quick actions -->
      <div class="glass reveal" style="padding:26px;display:flex;flex-direction:column;gap:14px;">
        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:600;margin-bottom:2px;">Actions rapides</div>

        <a href="{{ route('articles.create') }}" class="btn-primary" style="width:100%;justify-content:center;height:44px;font-size:14px;">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M12 5v14M5 12h14"/></svg>
          Nouvel article
        </a>

        <a href="{{ route('welcome') }}" class="quick-btn">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          Voir le blog public
        </a>

        <a href="{{ route('articles.create') }}" class="quick-btn warn">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
          Reprendre un brouillon
        </a>

        <hr style="border:none;border-top:1px solid rgba(255,255,255,0.06);margin:2px 0;" />

        <div class="mini-stats">
          <div class="mini-stat">
            <div class="mini-stat-val" style="color:var(--green);">67%</div>
            <div class="mini-stat-lbl">TAUX PUBLICATION</div>
          </div>
          <div class="mini-stat">
            <div class="mini-stat-val" style="color:var(--accent);">8.2</div>
            <div class="mini-stat-lbl">MIN MOY. LECTURE</div>
          </div>
        </div>
      </div>

    </div><!-- /bottom-grid -->

  </main>

  <!-- ══════════ DELETE MODAL ══════════ -->
  <div class="modal-overlay" id="deleteModal" onclick="closeModalBackdrop(event)">
    <div class="modal-card">
      <div style="width:60px;height:60px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 22px;">
        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#EF4444" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
      </div>
      <h3 style="font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;text-align:center;margin-bottom:10px;">Supprimer l&rsquo;article&nbsp;?</h3>
      <p id="modalArticleName" style="text-align:center;color:var(--text-2);font-size:14px;margin-bottom:8px;"></p>
      <p style="text-align:center;color:var(--text-3);font-size:13px;margin-bottom:30px;line-height:1.6;">Cette action est irr&eacute;versible. L&rsquo;article et toutes ses donn&eacute;es seront supprim&eacute;s d&eacute;finitivement.</p>
      <div style="display:flex;gap:10px;">
        <button class="btn-ghost" style="flex:1;" onclick="closeDeleteModal()">Annuler</button>
        <form id="deleteForm" method="POST" style="flex:1;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-danger" style="width:100%;">Supprimer</button>
        </form>
      </div>
    </div>
  </div>

  <!-- ══════════ TWEAKS PANEL ══════════ -->
  <div id="tweakPanel">
    <div class="glass" style="padding:22px;min-width:240px;border-radius:18px;">
      <div style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:600;color:var(--text-1);margin-bottom:16px;display:flex;align-items:center;gap:6px;">
        <span style="width:8px;height:8px;background:linear-gradient(135deg,#A855F7,#EC4899);border-radius:2px;display:inline-block;"></span>
        Tweaks
      </div>
      <label style="display:block;font-size:11px;color:var(--text-3);font-family:'JetBrains Mono',monospace;margin-bottom:6px;">ACCENT COLOR</label>
      <input type="color" value="#A855F7" oninput="applyTweak('accentColor',this.value)" style="width:100%;height:32px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.05);cursor:pointer;padding:2px;margin-bottom:14px;" />
      <label style="display:flex;align-items:center;gap:8px;font-size:11px;color:var(--text-3);font-family:'JetBrains Mono',monospace;cursor:pointer;margin-bottom:10px;">
        <input type="checkbox" id="twkTimeline" checked onchange="applyTweak('showTimeline',this.checked)" style="accent-color:#A855F7;" />
        ACTIVIT&Eacute; R&Eacute;CENTE
      </label>
      <label style="display:flex;align-items:center;gap:8px;font-size:11px;color:var(--text-3);font-family:'JetBrains Mono',monospace;cursor:pointer;">
        <input type="checkbox" id="twkViews" checked onchange="applyTweak('showViews',this.checked)" style="accent-color:#A855F7;" />
        COLONNE VUES
      </label>
    </div>
  </div>

  <script>
    // ── Cursor glow ──
    const cg = document.getElementById('cg');
    document.addEventListener('mousemove', function(e) {
      cg.style.left = e.clientX + 'px';
      cg.style.top  = e.clientY + 'px';
    });

    // ── Orb parallax ──
    const o1 = document.querySelector('.orb-1'), o2 = document.querySelector('.orb-2');
    document.addEventListener('mousemove', function(e) {
      const x = (e.clientX / window.innerWidth  - 0.5) * 32;
      const y = (e.clientY / window.innerHeight - 0.5) * 32;
      o1.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
      o2.style.transform = 'translate(' + (-x * 0.7) + 'px, ' + (-y * 0.7) + 'px)';
    });

    // ── Scroll reveal (staggered) ──
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(e, i) {
        if (e.isIntersecting) setTimeout(function() { e.target.classList.add('visible'); }, i * 55);
      });
    }, { threshold: 0.05 });
    document.querySelectorAll('.reveal').forEach(function(el) { obs.observe(el); });

    // ── Filter by status ──
    var currentStatus = 'all';
    var currentSearch = '';

    function setStatusFilter(chip, status) {
      document.querySelectorAll('.filter-pill').forEach(function(c) { c.classList.remove('active'); });
      chip.classList.add('active');
      currentStatus = status;
      applyFilters();
    }

    function filterRows(q) {
      currentSearch = q.toLowerCase();
      applyFilters();
    }

    function applyFilters() {
      var rows = document.querySelectorAll('#tableBody tr');
      var visible = 0;
      rows.forEach(function(row) {
        var sm = currentStatus === 'all' || row.dataset.status === currentStatus;
        var qm = currentSearch === '' || (row.dataset.title && row.dataset.title.includes(currentSearch));
        row.style.display = (sm && qm) ? '' : 'none';
        if (sm && qm) visible++;
      });
      document.getElementById('articleCount').textContent = visible + ' article' + (visible > 1 ? 's' : '');
      document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
    }

    // ── Delete modal ──
    var pendingDeleteId = null;

    function openDeleteModal(name, id) {
      pendingDeleteId = id;
      document.getElementById('modalArticleName').textContent = '« ' + name + ' »';
      var form = document.getElementById('deleteForm');
      form.action = '/articles/' + id + '/delete';
      document.getElementById('deleteModal').classList.add('open');
    }

    function closeDeleteModal() {
      document.getElementById('deleteModal').classList.remove('open');
    }

    function closeModalBackdrop(e) {
      if (e.target === document.getElementById('deleteModal')) closeDeleteModal();
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeDeleteModal();
    });

    // ── Tweaks panel ──
    window.addEventListener('message', function(e) {
      if (e.data && e.data.type === '__activate_edit_mode')   document.getElementById('tweakPanel').style.display = 'block';
      if (e.data && e.data.type === '__deactivate_edit_mode') document.getElementById('tweakPanel').style.display = 'none';
    });
    window.parent.postMessage({ type: '__edit_mode_available' }, '*');

    function applyTweak(k, v) {
      if (k === 'accentColor') {
        document.documentElement.style.setProperty('--accent', v);
        document.querySelector('.logo-box').style.background = 'linear-gradient(135deg,' + v + ',#EC4899)';
        document.querySelectorAll('.btn-primary').forEach(function(b) { b.style.background = 'linear-gradient(135deg,' + v + ',#EC4899)'; });
        document.querySelectorAll('.filter-pill.active').forEach(function(p) { p.style.background = 'linear-gradient(135deg,' + v + ',#EC4899)'; });
      }
      if (k === 'showTimeline') {
        var bg = document.getElementById('bottomGrid');
        bg.style.gridTemplateColumns = v ? '1fr 340px' : '1fr';
        bg.querySelector(':first-child').style.display = v ? '' : 'none';
      }
      if (k === 'showViews') {
        document.querySelectorAll('.col-views').forEach(function(el) { el.style.display = v ? '' : 'none'; });
      }
      window.parent.postMessage({ type: '__edit_mode_set_keys', edits: { [k]: v } }, '*');
    }

    // ── Stat counter animation ──
    document.querySelectorAll('.stat-value').forEach(function(el) {
      var target = parseFloat(el.textContent.replace(/[^0-9.]/g, ''));
      if (isNaN(target) || target === 0) return;
      var start = 0;
      var duration = 1200;
      var startTime = null;
      function step(ts) {
        if (!startTime) startTime = ts;
        var progress = Math.min((ts - startTime) / duration, 1);
        var ease = 1 - Math.pow(1 - progress, 3);
        var current = Math.round(ease * target);
        el.textContent = el.textContent.replace(/\d[\d,]*/, current.toLocaleString());
        if (progress < 1) requestAnimationFrame(step);
      }
      setTimeout(function() { requestAnimationFrame(step); }, 300);
    });
  </script>
</body>
</html>
