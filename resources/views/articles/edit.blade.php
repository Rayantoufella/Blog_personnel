@extends('layouts.app')

@section('title', 'Modifier — ' . $article->titre . ' — Blog personnel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
@endsection

@section('content')
    <div id="cg"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- NAVBAR -->
    <header class="navbar">
        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div class="logo-box">B</div>
            <span class="logo-text">Blog<span> personnel</span></span>
        </a>
        <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">Éditeur d'articles</span>
    </header>

    <!-- MAIN UPDATE FORM -->
    <form method="POST" action="{{ route('articles.update', $article) }}" id="mainForm">
        @csrf
        @method('PUT')

        <!-- EDITOR TOP BAR -->
        <div class="editor-topbar">
            <a href="{{ route('dashboard') }}" class="back-link">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                Retour
            </a>

            <div class="topbar-center">
                <span class="edit-label">Modification</span>
                <span style="color:rgba(255,255,255,.15);">·</span>
                <span class="edit-title" id="topbarTitle">{{ Str::limit($article->titre, 40) }}</span>
                <span style="color:rgba(255,255,255,.12);">·</span>
                <div class="save-indicator">
                    <span class="save-dot saved" id="saveDot"></span>
                    <span id="saveLabel" style="color:var(--green);">Tout est à jour</span>
                </div>
            </div>

            <div class="topbar-actions">
                <button type="button" class="btn-danger-outline" onclick="openDeleteModal()">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
                    Supprimer
                </button>
                <button type="submit" class="btn-secondary" onclick="setStatutAndSubmit('brouillon')">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                    Brouillon
                </button>
                <button type="submit" class="btn-primary">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Mettre à jour
                </button>
            </div>
        </div>

        <div class="editor-layout">

            <!-- MAIN EDITOR -->
            <div class="editor-main reveal">

                @if ($errors->any())
                    <div class="validation-errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <textarea id="titleInput" name="titre" rows="1" placeholder="Titre de l'article..." oninput="autoResize(this);onContentChange();syncTopbarTitle(this.value);" onkeydown="handleTitleKey(event)">{{ old('titre', $article->titre) }}</textarea>

                <div class="field-error" id="titleError">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Le titre est obligatoire.
                </div>

                <textarea id="contentInput" name="contenu" placeholder="Commencez à écrire votre article..." oninput="onContentChange();updateStats();">{{ old('contenu', $article->contenu) }}</textarea>

                <div class="field-error" id="contentError">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Le contenu ne peut pas être vide.
                </div>

            </div>

            <!-- SIDEBAR -->
            <aside class="editor-sidebar">

                <!-- HISTORY CARD -->
                <div class="glass sidebar-card reveal" style="transition-delay:.0s;">
                    <div class="card-label">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Historique
                    </div>
                    <div class="hist-row">
                        <span class="hist-key">Créé le</span>
                        <span class="hist-val">{{ $article->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="hist-row">
                        <span class="hist-key">Modifié le</span>
                        <span class="hist-val">{{ $article->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    @if($article->date_publication)
                    <div class="hist-row">
                        <span class="hist-key">Publié le</span>
                        <span class="hist-val" style="color:var(--green);">{{ $article->date_publication->format('d M Y') }}</span>
                    </div>
                    @endif
                    @if($article->views)
                    <div class="hist-row">
                        <span class="hist-key">Vues</span>
                        <span class="hist-val" style="color:#06B6D4;">{{ number_format($article->views) }}</span>
                    </div>
                    @endif
                </div>

                <!-- CATEGORY -->
                <div class="glass sidebar-card reveal" style="transition-delay:.05s;">
                    <div class="card-label">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
                        Catégorie
                    </div>
                    <div class="cat-grid">
                        @foreach($categories as $cat)
                            @php
                                $isSelected = (old('category_id', $article->category_id) == $cat->id) ? 'selected' : '';
                            @endphp
                            <div class="cat-option {{ $isSelected }}" onclick="selectCat(this, {{ $cat->id }})">
                                <div class="cat-icon">📁</div>
                                <div class="cat-name">{{ $cat->nom }}</div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="category_id" id="catInput" value="{{ old('category_id', $article->category_id) }}" />
                </div>

                <!-- STATUS -->
                <div class="glass sidebar-card reveal" style="transition-delay:.1s;">
                    <div class="card-label">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                        Statut
                    </div>
                    @php $currentStatut = old('statut', $article->statut); @endphp
                    <div class="status-option {{ $currentStatut === 'brouillon' ? 'selected' : '' }}" id="statusDraft" onclick="selectStatus('brouillon')">
                        <span class="status-icon">📝</span>
                        <div>
                            <div class="status-title">Brouillon</div>
                            <div class="status-desc">Privé, visible uniquement dans ton dashboard</div>
                        </div>
                    </div>
                    <div class="status-option {{ $currentStatut === 'publie' ? 'selected' : '' }}" id="statusPublished" onclick="selectStatus('publie')">
                        <span class="status-icon">🌐</span>
                        <div>
                            <div class="status-title">Publié</div>
                            <div class="status-desc">Visible par tous les visiteurs de ton blog</div>
                        </div>
                    </div>
                    <input type="hidden" name="statut" id="statutInput" value="{{ $currentStatut }}" />
                </div>

                <!-- STATS -->
                <div class="glass sidebar-card reveal" style="transition-delay:.15s;">
                    <div class="card-label">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                        Statistiques
                    </div>
                    <div class="stat-row"><span class="stat-key">Mots</span><span class="stat-val" id="wordCount">0</span></div>
                    <div class="stat-row"><span class="stat-key">Lecture estimée</span><span class="stat-val" id="readTime">0 min</span></div>
                    <div class="stat-row"><span class="stat-key">Caractères</span><span class="stat-val" id="charCountSide">0</span></div>
                </div>

                <!-- DANGER ZONE -->
                <div class="danger-card reveal" style="transition-delay:.25s;">
                    <div class="danger-label">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        Zone dangereuse
                    </div>
                    <button type="button" class="btn-danger-full" onclick="openDeleteModal()">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
                        Supprimer définitivement
                    </button>
                </div>

            </aside>
        </div>

        <!-- BOTTOM BAR -->
        <div class="bottom-bar">
            <div style="display:flex;align-items:center;gap:8px;">
                <div class="save-dot saved" id="saveDot2"></div>
                <span id="saveLabel2" style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--green);">Tout est à jour</span>
            </div>
            <a href="{{ route('dashboard') }}" style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);text-decoration:none;display:flex;align-items:center;gap:5px;transition:color .2s;" onmouseenter="this.style.color='#C084FC'" onmouseleave="this.style.color='var(--text-3)'">
                ← Retour au dashboard
            </a>
            <div style="display:flex;gap:8px;">
                <button type="button" class="btn-danger-outline" onclick="openDeleteModal()">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
                </button>
                <button type="submit" class="btn-secondary" onclick="setStatutAndSubmit('brouillon')">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                    Brouillon
                </button>
                <button type="submit" class="btn-primary">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Mettre à jour
                </button>
            </div>
        </div>

    </form>

    <!-- DELETE FORM -->
    <form method="POST" action="{{ route('articles.delete', $article) }}" id="deleteForm">
        @csrf
        @method('DELETE')
    </form>

    <!-- DELETE MODAL -->
    <div class="modal-overlay" id="deleteModal" onclick="overlayClose(event)">
        <div class="modal-card">
            <div style="width:60px;height:60px;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;box-shadow:0 0 20px rgba(239,68,68,.2);">
                <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#EF4444" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
            </div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;text-align:center;margin-bottom:10px;letter-spacing:-.015em;">Tu es sûr ?</h3>
            <p style="text-align:center;color:var(--text-2);font-size:15px;line-height:1.65;margin-bottom:6px;">
                L'article <strong style="color:rgba(252,165,165,.9);">"{{ Str::limit($article->titre, 40) }}"</strong> sera définitivement supprimé.
            </p>
            <p style="text-align:center;color:var(--text-3);font-size:13px;margin-bottom:28px;">Cette action ne peut pas être annulée.</p>

            <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:11px;color:rgba(252,165,165,.6);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;">
                Tape <span style="color:rgba(239,68,68,.8);font-weight:700;">SUPPRIMER</span> pour confirmer
            </label>
            <input class="confirm-input" type="text" id="confirmInput" placeholder="SUPPRIMER" oninput="checkConfirm(this.value)" autocomplete="off" spellcheck="false" />

            <div style="display:flex;gap:10px;">
                <button class="btn-cancel-modal" onclick="closeDeleteModal()">Annuler</button>
                <button class="btn-delete-confirm" id="deleteConfirmBtn" disabled onclick="confirmDelete()">Supprimer définitivement</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/editor.js') }}"></script>
@endsection
