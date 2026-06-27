<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resume Builder — Nabeel Shehzad</title>
<style>
/* ═══════════════════════════════════════════════════════
   RESET & TOKENS
═══════════════════════════════════════════════════════ */
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

:root {
  --bg:       #f0f2f5;
  --panel:    #ffffff;
  --sidebar:  #1e2535;
  --sidebar2: #252d40;
  --accent:   #4f80ff;
  --accent2:  #3a65e0;
  --danger:   #e05555;
  --text:     #1a1d2e;
  --muted:    #6b7280;
  --border:   #e5e7eb;
  --input-bg: #f9fafb;
  --radius:   8px;
  --shadow:   0 2px 12px rgba(0,0,0,.08);
}

body {
  font-family: 'Segoe UI', system-ui, sans-serif;
  background: var(--bg);
  color: var(--text);
  height: 100vh;
  display: flex;
  overflow: hidden;
}

/* ═══════════════════════════════════════════════════════
   SIDEBAR NAV
═══════════════════════════════════════════════════════ */
#sidebar {
  width: 220px;
  flex-shrink: 0;
  background: var(--sidebar);
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  z-index: 10;
}

.sidebar-logo {
  padding: 20px 18px 14px;
  font-size: 13px;
  font-weight: 700;
  color: #fff;
  letter-spacing: .5px;
  border-bottom: 1px solid rgba(255,255,255,.08);
}
.sidebar-logo span { color: var(--accent); }

.nav-section {
  padding: 12px 0 4px;
}
.nav-label {
  padding: 0 18px 6px;
  font-size: 10px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: rgba(255,255,255,.35);
}
.nav-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 9px 18px;
  cursor: pointer;
  font-size: 13px;
  color: rgba(255,255,255,.65);
  border-left: 3px solid transparent;
  transition: all .15s;
  user-select: none;
}
.nav-item:hover { background: rgba(255,255,255,.06); color: #fff; }
.nav-item.active { background: rgba(79,128,255,.18); color: #fff; border-left-color: var(--accent); }
.nav-icon { width: 16px; text-align: center; font-size: 13px; }

/* ═══════════════════════════════════════════════════════
   EDITOR PANEL
═══════════════════════════════════════════════════════ */
#editor {
  width: 380px;
  flex-shrink: 0;
  background: var(--panel);
  border-right: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.editor-header {
  padding: 16px 20px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
}
.editor-header h2 { font-size: 15px; font-weight: 600; color: var(--text); }

#editor-body {
  flex: 1;
  overflow-y: auto;
  padding: 20px;
}
#editor-body::-webkit-scrollbar { width: 5px; }
#editor-body::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

/* ── Form groups ── */
.form-group { margin-bottom: 14px; }
.form-group label {
  display: block;
  font-size: 11.5px;
  font-weight: 600;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: .5px;
  margin-bottom: 5px;
}
.form-group input,
.form-group textarea,
.form-group select {
  width: 100%;
  padding: 8px 10px;
  border: 1px solid var(--border);
  border-radius: var(--radius);
  font-size: 13px;
  font-family: inherit;
  background: var(--input-bg);
  color: var(--text);
  transition: border-color .15s, box-shadow .15s;
  resize: vertical;
}
.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(79,128,255,.12);
  background: #fff;
}
.form-group textarea { min-height: 72px; }

/* ── Entries (experience / project / skill) ── */
.entry-card {
  border: 1px solid var(--border);
  border-radius: var(--radius);
  margin-bottom: 12px;
  overflow: hidden;
}
.entry-card-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 9px 12px;
  background: #f9fafb;
  cursor: pointer;
  user-select: none;
  gap: 8px;
}
.entry-card-head:hover { background: #f3f4f6; }
.entry-card-title { font-size: 13px; font-weight: 600; color: var(--text); flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.entry-card-body { padding: 12px; border-top: 1px solid var(--border); }
.entry-card-body.hidden { display: none; }
.toggle-icon { font-size: 11px; color: var(--muted); transition: transform .2s; }
.toggle-icon.open { transform: rotate(180deg); }

/* ── Bullet list editor ── */
.bullet-list { list-style: none; }
.bullet-item {
  display: flex;
  align-items: flex-start;
  gap: 6px;
  margin-bottom: 6px;
}
.bullet-item textarea {
  flex: 1;
  min-height: 52px;
  font-size: 12.5px;
  padding: 6px 8px;
}
.btn-icon {
  flex-shrink: 0;
  width: 28px;
  height: 28px;
  border: 1px solid var(--border);
  border-radius: 6px;
  background: #fff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  color: var(--muted);
  transition: all .15s;
  margin-top: 2px;
}
.btn-icon:hover { border-color: var(--danger); color: var(--danger); background: #fff5f5; }
.btn-icon.add:hover { border-color: var(--accent); color: var(--accent); background: #f0f4ff; }

/* ── Buttons ── */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 14px;
  border-radius: var(--radius);
  font-size: 12.5px;
  font-weight: 600;
  cursor: pointer;
  border: none;
  transition: all .15s;
  font-family: inherit;
}
.btn-primary { background: var(--accent); color: #fff; }
.btn-primary:hover { background: var(--accent2); }
.btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
.btn-ghost:hover { background: var(--bg); color: var(--text); }
.btn-danger { background: transparent; color: var(--danger); border: 1px solid #fca5a5; }
.btn-danger:hover { background: #fef2f2; }
.btn-sm { padding: 5px 10px; font-size: 12px; }

.add-entry-btn {
  width: 100%;
  padding: 9px;
  border: 1.5px dashed var(--border);
  border-radius: var(--radius);
  background: transparent;
  color: var(--muted);
  font-size: 13px;
  font-family: inherit;
  cursor: pointer;
  transition: all .15s;
  margin-top: 4px;
}
.add-entry-btn:hover { border-color: var(--accent); color: var(--accent); background: #f0f4ff; }

/* ── Section tabs ── */
.section-tabs { display: none; }
#editor-body.active .section-tabs { display: block; }

/* ═══════════════════════════════════════════════════════
   PREVIEW PANEL
═══════════════════════════════════════════════════════ */
#preview-panel {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  background: var(--bg);
}

.preview-toolbar {
  padding: 12px 20px;
  background: var(--panel);
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
}
.preview-toolbar-left { display: flex; align-items: center; gap: 12px; }
.preview-label { font-size: 13px; font-weight: 600; color: var(--muted); }

.zoom-controls { display: flex; align-items: center; gap: 4px; }
.zoom-btn {
  width: 28px; height: 28px;
  border: 1px solid var(--border);
  border-radius: 6px;
  background: #fff;
  cursor: pointer;
  font-size: 14px;
  display: flex; align-items: center; justify-content: center;
  color: var(--muted);
  transition: all .15s;
}
.zoom-btn:hover { border-color: var(--accent); color: var(--accent); }
#zoom-label { font-size: 12px; color: var(--muted); width: 40px; text-align: center; }

#preview-scroll {
  flex: 1;
  overflow: auto;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 30px 20px 50px;
}
#preview-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
#preview-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }

/* ── Preview zoom wrapper ── */
#zoom-wrapper {
  transform-origin: top center;
  transition: transform .2s;
}

/* ══════════════════════════════════════════════════════
   RESUME PAPER
══════════════════════════════════════════════════════ */
#resume {
  width: 816px;
  min-height: 1056px;
  background: #fff;
  padding: 54px 80px 54px 80px;
  box-shadow: 0 4px 32px rgba(0,0,0,.15);
  font-family: 'Times New Roman', Times, serif;
  font-size: 10.5pt;
  line-height: 1.24;
  color: #000;
  position: relative;
}

/* ── Resume header ── */
.r-header { text-align: center; margin-bottom: 6pt; }
.r-name { font-size: 21pt; font-weight: bold; letter-spacing: .3px; margin-bottom: 2pt; }
.r-contact { font-size: 10pt; line-height: 1.5; }
.r-contact a { color: #1155cc; text-decoration: underline; }

/* ── Section ── */
.r-section { margin-top: 6pt; }
.r-section-title {
  font-size: 10.5pt;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: .4px;
  border-bottom: .75pt solid #000;
  padding-bottom: 1pt;
  margin-bottom: 4pt;
}

/* ── Summary ── */
.r-summary { text-align: justify; font-size: 10pt; line-height: 1.26; }

/* ── Skills ── */
.r-skills { list-style: disc; padding-left: 18pt; }
.r-skills li { font-size: 10pt; line-height: 1.24; }

/* ── Experience ── */
.r-exp { margin-bottom: 6pt; }
.r-row { display: flex; justify-content: space-between; align-items: baseline; }
.r-company { font-weight: bold; font-size: 10.5pt; }
.r-date { font-size: 10pt; white-space: nowrap; }
.r-jobtitle { font-style: italic; font-size: 10pt; }
.r-loc { font-size: 10pt; }
.r-bullets { list-style: disc; padding-left: 18pt; margin-top: 2pt; }
.r-bullets li { font-size: 10pt; line-height: 1.24; text-align: justify; }

/* ── Projects ── */
.r-proj { margin-bottom: 5pt; }
.r-proj-title { font-weight: bold; font-size: 10.5pt; }

/* ── Education ── */
.r-edu-inst { font-weight: bold; font-size: 10.5pt; }
.r-edu-degree { font-style: italic; font-size: 10pt; }

/* ═══════════════════════════════════════════════════════
   PRINT — only #resume, perfect fit
═══════════════════════════════════════════════════════ */
@media print {
  @page { size: 8.5in 11in; margin: 0; }
  * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  body { background: none; }
  #sidebar, #editor, .preview-toolbar { display: none !important; }
  #preview-panel { display: block; overflow: visible; }
  #preview-scroll { padding: 0; overflow: visible; display: block; }
  #zoom-wrapper { transform: none !important; }
  #resume {
    box-shadow: none;
    width: 8.5in;
    min-height: 11in;
    padding: 0.56in 0.83in 0.56in 0.83in;
    margin: 0;
    font-size: 10.5pt;
    line-height: 1.24;
  }
}
</style>
</head>
<body>

<!-- ══════════════════════════════════════════
     SIDEBAR
══════════════════════════════════════════ -->
<nav id="sidebar">
  <div class="sidebar-logo">Resume<span>Builder</span></div>
  <div class="nav-section">
    <div class="nav-label">Sections</div>
    <div class="nav-item active" onclick="showSection('header')"><span class="nav-icon">👤</span> Personal Info</div>
    <div class="nav-item" onclick="showSection('summary')"><span class="nav-icon">📝</span> Summary</div>
    <div class="nav-item" onclick="showSection('skills')"><span class="nav-icon">⚡</span> Skills</div>
    <div class="nav-item" onclick="showSection('experience')"><span class="nav-icon">💼</span> Experience</div>
    <div class="nav-item" onclick="showSection('projects')"><span class="nav-icon">🚀</span> Projects</div>
    <div class="nav-item" onclick="showSection('education')"><span class="nav-icon">🎓</span> Education</div>
  </div>
</nav>

<!-- ══════════════════════════════════════════
     EDITOR
══════════════════════════════════════════ -->
<div id="editor">
  <div class="editor-header">
    <h2 id="editor-title">Personal Info</h2>
  </div>
  <div id="editor-body">

    <!-- PERSONAL INFO -->
    <div id="sec-header" class="editor-section">
      <div class="form-group"><label>Full Name</label><input id="f-name" oninput="liveUpdate()" placeholder="Your Name"></div>
      <div class="form-group"><label>Location</label><input id="f-location" oninput="liveUpdate()" placeholder="City, State, Country"></div>
      <div class="form-group"><label>Phone</label><input id="f-phone" oninput="liveUpdate()" placeholder="+1 234 567 8900"></div>
      <div class="form-group"><label>Email</label><input id="f-email" oninput="liveUpdate()" type="email" placeholder="you@email.com"></div>
      <div class="form-group"><label>LinkedIn URL</label><input id="f-linkedin" oninput="liveUpdate()" placeholder="linkedin.com/in/username"></div>
      <div class="form-group"><label>GitHub URL</label><input id="f-github" oninput="liveUpdate()" placeholder="github.com/username"></div>
    </div>

    <!-- SUMMARY -->
    <div id="sec-summary" class="editor-section" style="display:none">
      <div class="form-group">
        <label>Professional Summary</label>
        <textarea id="f-summary" oninput="liveUpdate()" rows="7" placeholder="Write your professional summary here..."></textarea>
      </div>
    </div>

    <!-- SKILLS -->
    <div id="sec-skills" class="editor-section" style="display:none">
      <div id="skills-list"></div>
      <button class="add-entry-btn" onclick="addSkill()">+ Add Skill Category</button>
    </div>

    <!-- EXPERIENCE -->
    <div id="sec-experience" class="editor-section" style="display:none">
      <div id="experience-list"></div>
      <button class="add-entry-btn" onclick="addExperience()">+ Add Experience</button>
    </div>

    <!-- PROJECTS -->
    <div id="sec-projects" class="editor-section" style="display:none">
      <div id="projects-list"></div>
      <button class="add-entry-btn" onclick="addProject()">+ Add Project</button>
    </div>

    <!-- EDUCATION -->
    <div id="sec-education" class="editor-section" style="display:none">
      <div id="education-list"></div>
      <button class="add-entry-btn" onclick="addEducation()">+ Add Education</button>
    </div>

  </div>
</div>

<!-- ══════════════════════════════════════════
     PREVIEW
══════════════════════════════════════════ -->
<div id="preview-panel">
  <div class="preview-toolbar">
    <div class="preview-toolbar-left">
      <span class="preview-label">Live Preview</span>
      <div class="zoom-controls">
        <button class="zoom-btn" onclick="changeZoom(-0.1)">−</button>
        <span id="zoom-label">75%</span>
        <button class="zoom-btn" onclick="changeZoom(0.1)">+</button>
      </div>
    </div>
    <div style="display:flex;gap:8px">
      <button class="btn btn-ghost btn-sm" onclick="resetData()">↺ Reset</button>
      <button class="btn btn-primary btn-sm" onclick="exportPDF()">↓ Export PDF</button>
    </div>
  </div>
  <div id="preview-scroll">
    <div id="zoom-wrapper">
      <div id="resume">
        <!-- rendered by JS -->
      </div>
    </div>
  </div>
</div>

<script>
/* ══════════════════════════════════════════════════
   DATA MODEL
══════════════════════════════════════════════════ */
let data = {
  name:     'Nabeel Shehzad',
  location: 'Sialkot, Punjab, Pakistan',
  phone:    '+92 309 7367969',
  email:    'nabeelshahzad88@gmail.com',
  linkedin: 'linkedin.com/in/nabeel-shehzad',
  github:   'github.com/Nabeel-Shehzad',
  summary:  'Senior Software Engineer with over 5 years of experience specializing in AI-driven ecosystems and high-performance mobile applications. Expert in architecting RAG (Retrieval-Augmented Generation) pipelines, real-time Machine Learning ensembles, and scalable backend infrastructures. Proven track record in leading end-to-end development lifecycles for complex, multi-tenant production environments.',
  skills: [
    { label: 'AI & Machine Learning', items: 'RAG Architectures, Gemini AI API, NLP (mBERT, Bi-LSTM), ChromaDB (Vector DB).' },
    { label: 'Languages',             items: 'Python (FastAPI), Dart (Flutter), JavaScript, Java, PHP, SQL, C++.' },
    { label: 'Mobile/Web',            items: 'Flutter, WearOS, watchOS, React Native, Three.js, Material UI (MUI).' },
    { label: 'Backend & DevOps',      items: 'Supabase (Auth/RLS), Firebase, JWT, GitHub Actions (CI/CD), Docker.' },
    { label: 'Core CS',               items: 'System Design, Algorithm Optimization, Database Concurrency (2PL), Statistical Modeling.' },
  ],
  experience: [
    {
      company: 'CodesMine Software Solutions', period: 'Jan 2023 – Present',
      title: 'Senior Software Engineer',       location: 'Sialkot, Pakistan',
      bullets: [
        'Leading the architecture of multi-tenant AI services, implementing secure data isolation and real-time streaming protocols.',
        'Architecting specialized search engines for multilingual text databases, optimizing for sub-500ms retrieval latencies.',
        'Spearheading the integration of LLMs into production workflows, focusing on context-aware retrieval and prompt engineering.',
        'Managing full-stack performance tuning, including state management and advanced database concurrency control.',
      ]
    },
    {
      company: 'Infinky Solutions',   period: 'Jan 2021 – Dec 2022',
      title: 'Mobile App Developer', location: 'Sialkot, Pakistan',
      bullets: [
        'Developed and deployed high-traffic cross-platform mobile applications, improving user engagement by implementing responsive UIs.',
        'Engineered robust offline-first synchronization modules using SQLite and background services for data consistency.',
        'Collaborated with cross-functional teams to translate complex business requirements into technical specifications.',
      ]
    },
  ],
  projects: [
    {
      title: 'DocuMind — Document Intelligence Platform (AI/RAG)', year: '2026',
      bullets: [
        'Architected a full-stack RAG pipeline: PDF extraction → recursive chunking → vector embeddings → generation.',
        'Built a high-performance <strong>FastAPI</strong> backend with <strong>ChromaDB</strong> for real-time semantic document querying.',
        'Implemented streaming AI responses using <strong>Server-Sent Events (SSE)</strong> and <strong>Dart Async Generators</strong> in Flutter.',
      ]
    },
    {
      title: 'SMS Spam Detection System (ML/NLP/Ensemble)', year: '2025',
      bullets: [
        'Engineered a hybrid classification ensemble (Naive Bayes, SVM, Bi-LSTM) with multilingual support via <strong>mBERT</strong>.',
        'Integrated <strong>Adversarial Text Normalization</strong> and <strong>Adaptive Learning</strong> loops to combat evolving spam patterns.',
      ]
    },
    {
      title: 'Smart Hajj & Umrah Companion (Wearable Technology)', year: '2025',
      bullets: [
        'Developed a location-aware <strong>WearOS/watchOS</strong> solution with <strong>Gemini AI</strong> for real-time ritual guidance.',
        'Integrated family safety features including geofencing and real-time location streaming via <strong>Firestore</strong>.',
      ]
    },
  ],
  education: [
    {
      institution: 'GIFT University', period: 'Oct 2020',
      degree: 'Bachelor of Computer Science, Specialization in Software Engineering',
      location: 'Gujranwala, Pakistan',
    },
  ],
};

/* ══════════════════════════════════════════════════
   ZOOM
══════════════════════════════════════════════════ */
let zoom = 0.75;
function changeZoom(delta) {
  zoom = Math.min(1.2, Math.max(0.4, zoom + delta));
  document.getElementById('zoom-wrapper').style.transform = `scale(${zoom})`;
  document.getElementById('zoom-label').textContent = Math.round(zoom * 100) + '%';
}
document.getElementById('zoom-wrapper').style.transform = `scale(${zoom})`;

/* ══════════════════════════════════════════════════
   SECTION NAV
══════════════════════════════════════════════════ */
const sectionTitles = {
  header: 'Personal Info', summary: 'Summary', skills: 'Skills',
  experience: 'Experience', projects: 'Projects', education: 'Education'
};
let currentSection = 'header';

function showSection(name) {
  document.querySelectorAll('.editor-section').forEach(el => el.style.display = 'none');
  document.getElementById('sec-' + name).style.display = 'block';
  document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
  event.currentTarget.classList.add('active');
  document.getElementById('editor-title').textContent = sectionTitles[name];
  currentSection = name;
}

/* ══════════════════════════════════════════════════
   RENDER RESUME
══════════════════════════════════════════════════ */
function esc(str) {
  return String(str || '')
    .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
    .replace(/"/g,'&quot;');
}

function renderResume() {
  const d = data;
  let html = '';

  // Header
  html += `<div class="r-header">
    <div class="r-name">${esc(d.name)}</div>
    <div class="r-contact">
      ${esc(d.location)}${d.location && d.phone ? ' | ' : ''}${esc(d.phone)}${d.phone && d.email ? ' | ' : ''}<a href="mailto:${esc(d.email)}">${esc(d.email)}</a>
    </div>
    <div class="r-contact">
      ${d.linkedin ? `<a href="https://${esc(d.linkedin)}" target="_blank">${esc(d.linkedin)}</a>` : ''}
      ${d.linkedin && d.github ? ' | ' : ''}
      ${d.github ? `<a href="https://${esc(d.github)}" target="_blank">${esc(d.github)}</a>` : ''}
    </div>
  </div>`;

  // Summary
  if (d.summary) {
    html += `<div class="r-section">
      <div class="r-section-title">Summary</div>
      <p class="r-summary">${esc(d.summary)}</p>
    </div>`;
  }

  // Skills
  if (d.skills.length) {
    html += `<div class="r-section"><div class="r-section-title">Technical Skills</div><ul class="r-skills">`;
    d.skills.forEach(s => {
      if (s.label || s.items)
        html += `<li>${s.label ? `<strong>${esc(s.label)}:</strong> ` : ''}${esc(s.items)}</li>`;
    });
    html += `</ul></div>`;
  }

  // Experience
  if (d.experience.length) {
    html += `<div class="r-section"><div class="r-section-title">Professional Experience</div>`;
    d.experience.forEach(e => {
      html += `<div class="r-exp">
        <div class="r-row"><span class="r-company">${esc(e.company)}</span><span class="r-date">${esc(e.period)}</span></div>
        <div class="r-row"><span class="r-jobtitle">${esc(e.title)}</span><span class="r-loc">${esc(e.location)}</span></div>
        <ul class="r-bullets">${e.bullets.filter(b=>b.trim()).map(b=>`<li>${esc(b)}</li>`).join('')}</ul>
      </div>`;
    });
    html += `</div>`;
  }

  // Projects
  if (d.projects.length) {
    html += `<div class="r-section"><div class="r-section-title">Key Projects</div>`;
    d.projects.forEach(p => {
      html += `<div class="r-proj">
        <div class="r-row"><span class="r-proj-title">${esc(p.title)}</span><span class="r-date">${esc(p.year)}</span></div>
        <ul class="r-bullets">${p.bullets.filter(b=>b.trim()).map(b=>`<li>${b}</li>`).join('')}</ul>
      </div>`;
    });
    html += `</div>`;
  }

  // Education
  if (d.education.length) {
    html += `<div class="r-section"><div class="r-section-title">Education</div>`;
    d.education.forEach(e => {
      html += `<div class="r-exp">
        <div class="r-row"><span class="r-edu-inst">${esc(e.institution)}</span><span class="r-date">${esc(e.period)}</span></div>
        <div class="r-row"><span class="r-edu-degree">${esc(e.degree)}</span><span class="r-loc">${esc(e.location)}</span></div>
      </div>`;
    });
    html += `</div>`;
  }

  document.getElementById('resume').innerHTML = html;
}

/* ══════════════════════════════════════════════════
   LIVE UPDATE FROM FORM FIELDS
══════════════════════════════════════════════════ */
function liveUpdate() {
  data.name     = document.getElementById('f-name').value;
  data.location = document.getElementById('f-location').value;
  data.phone    = document.getElementById('f-phone').value;
  data.email    = document.getElementById('f-email').value;
  data.linkedin = document.getElementById('f-linkedin').value;
  data.github   = document.getElementById('f-github').value;
  data.summary  = document.getElementById('f-summary').value;
  renderResume();
}

/* ══════════════════════════════════════════════════
   SKILLS EDITOR
══════════════════════════════════════════════════ */
function renderSkillsEditor() {
  const container = document.getElementById('skills-list');
  container.innerHTML = '';
  data.skills.forEach((s, i) => {
    const card = document.createElement('div');
    card.className = 'entry-card';
    card.innerHTML = `
      <div class="entry-card-head" onclick="toggleCard(this)">
        <span class="entry-card-title">${s.label || 'New Skill Category'}</span>
        <button class="btn btn-danger btn-sm" onclick="event.stopPropagation();removeSkill(${i})" style="flex-shrink:0">✕</button>
        <span class="toggle-icon open">▼</span>
      </div>
      <div class="entry-card-body">
        <div class="form-group"><label>Category Label</label>
          <input value="${esc(s.label)}" oninput="data.skills[${i}].label=this.value;renderSkillsEditor();renderResume()" placeholder="e.g. Programming Languages">
        </div>
        <div class="form-group"><label>Skills (comma-separated)</label>
          <input value="${esc(s.items)}" oninput="data.skills[${i}].items=this.value;renderResume()" placeholder="Python, JavaScript, SQL...">
        </div>
      </div>`;
    container.appendChild(card);
  });
}

function addSkill() {
  data.skills.push({ label: '', items: '' });
  renderSkillsEditor();
}
function removeSkill(i) {
  data.skills.splice(i, 1);
  renderSkillsEditor();
  renderResume();
}

/* ══════════════════════════════════════════════════
   EXPERIENCE EDITOR
══════════════════════════════════════════════════ */
function renderExperienceEditor() {
  const container = document.getElementById('experience-list');
  container.innerHTML = '';
  data.experience.forEach((e, i) => {
    const card = document.createElement('div');
    card.className = 'entry-card';
    const bulletsHtml = e.bullets.map((b, bi) => `
      <div class="bullet-item">
        <textarea oninput="data.experience[${i}].bullets[${bi}]=this.value;renderResume()" placeholder="Bullet point...">${esc(b)}</textarea>
        <button class="btn-icon" onclick="removeExpBullet(${i},${bi})">✕</button>
      </div>`).join('');
    card.innerHTML = `
      <div class="entry-card-head" onclick="toggleCard(this)">
        <span class="entry-card-title">${e.company || 'New Position'}</span>
        <button class="btn btn-danger btn-sm" onclick="event.stopPropagation();removeExperience(${i})" style="flex-shrink:0">✕</button>
        <span class="toggle-icon open">▼</span>
      </div>
      <div class="entry-card-body">
        <div class="form-group"><label>Company</label>
          <input value="${esc(e.company)}" oninput="data.experience[${i}].company=this.value;renderExperienceEditor();renderResume()" placeholder="Company Name">
        </div>
        <div class="form-group"><label>Job Title</label>
          <input value="${esc(e.title)}" oninput="data.experience[${i}].title=this.value;renderResume()" placeholder="Senior Developer">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <div class="form-group"><label>Period</label>
            <input value="${esc(e.period)}" oninput="data.experience[${i}].period=this.value;renderResume()" placeholder="Jan 2022 – Present">
          </div>
          <div class="form-group"><label>Location</label>
            <input value="${esc(e.location)}" oninput="data.experience[${i}].location=this.value;renderResume()" placeholder="City, Country">
          </div>
        </div>
        <div class="form-group"><label>Bullet Points</label>
          <ul class="bullet-list">${bulletsHtml}</ul>
          <button class="add-entry-btn btn-sm" style="margin-top:6px" onclick="addExpBullet(${i})">+ Add bullet</button>
        </div>
      </div>`;
    container.appendChild(card);
  });
}

function addExperience() {
  data.experience.push({ company:'', period:'', title:'', location:'', bullets:[''] });
  renderExperienceEditor(); renderResume();
}
function removeExperience(i) {
  data.experience.splice(i, 1); renderExperienceEditor(); renderResume();
}
function addExpBullet(i) {
  data.experience[i].bullets.push(''); renderExperienceEditor(); renderResume();
}
function removeExpBullet(i, bi) {
  data.experience[i].bullets.splice(bi, 1); renderExperienceEditor(); renderResume();
}

/* ══════════════════════════════════════════════════
   PROJECTS EDITOR
══════════════════════════════════════════════════ */
function renderProjectsEditor() {
  const container = document.getElementById('projects-list');
  container.innerHTML = '';
  data.projects.forEach((p, i) => {
    const card = document.createElement('div');
    card.className = 'entry-card';
    const bulletsHtml = p.bullets.map((b, bi) => `
      <div class="bullet-item">
        <textarea oninput="data.projects[${i}].bullets[${bi}]=this.value;renderResume()" placeholder="Bullet point...">${b}</textarea>
        <button class="btn-icon" onclick="removeProjBullet(${i},${bi})">✕</button>
      </div>`).join('');
    card.innerHTML = `
      <div class="entry-card-head" onclick="toggleCard(this)">
        <span class="entry-card-title">${p.title || 'New Project'}</span>
        <button class="btn btn-danger btn-sm" onclick="event.stopPropagation();removeProject(${i})" style="flex-shrink:0">✕</button>
        <span class="toggle-icon open">▼</span>
      </div>
      <div class="entry-card-body">
        <div style="display:grid;grid-template-columns:1fr auto;gap:10px;align-items:start">
          <div class="form-group" style="margin:0"><label>Project Title</label>
            <input value="${p.title}" oninput="data.projects[${i}].title=this.value;renderProjectsEditor();renderResume()" placeholder="My Awesome Project">
          </div>
          <div class="form-group" style="margin:0;width:70px"><label>Year</label>
            <input value="${esc(p.year)}" oninput="data.projects[${i}].year=this.value;renderResume()" placeholder="2025">
          </div>
        </div>
        <div class="form-group" style="margin-top:10px"><label>Bullet Points</label>
          <ul class="bullet-list">${bulletsHtml}</ul>
          <button class="add-entry-btn btn-sm" style="margin-top:6px" onclick="addProjBullet(${i})">+ Add bullet</button>
        </div>
      </div>`;
    container.appendChild(card);
  });
}

function addProject() {
  data.projects.push({ title:'', year:'', bullets:[''] });
  renderProjectsEditor(); renderResume();
}
function removeProject(i) {
  data.projects.splice(i, 1); renderProjectsEditor(); renderResume();
}
function addProjBullet(i) {
  data.projects[i].bullets.push(''); renderProjectsEditor(); renderResume();
}
function removeProjBullet(i, bi) {
  data.projects[i].bullets.splice(bi, 1); renderProjectsEditor(); renderResume();
}

/* ══════════════════════════════════════════════════
   EDUCATION EDITOR
══════════════════════════════════════════════════ */
function renderEducationEditor() {
  const container = document.getElementById('education-list');
  container.innerHTML = '';
  data.education.forEach((e, i) => {
    const card = document.createElement('div');
    card.className = 'entry-card';
    card.innerHTML = `
      <div class="entry-card-head" onclick="toggleCard(this)">
        <span class="entry-card-title">${e.institution || 'New Education'}</span>
        <button class="btn btn-danger btn-sm" onclick="event.stopPropagation();removeEducation(${i})" style="flex-shrink:0">✕</button>
        <span class="toggle-icon open">▼</span>
      </div>
      <div class="entry-card-body">
        <div class="form-group"><label>Institution</label>
          <input value="${esc(e.institution)}" oninput="data.education[${i}].institution=this.value;renderEducationEditor();renderResume()" placeholder="University Name">
        </div>
        <div class="form-group"><label>Degree</label>
          <input value="${esc(e.degree)}" oninput="data.education[${i}].degree=this.value;renderResume()" placeholder="Bachelor of Science in Computer Science">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <div class="form-group"><label>Year / Period</label>
            <input value="${esc(e.period)}" oninput="data.education[${i}].period=this.value;renderResume()" placeholder="May 2022">
          </div>
          <div class="form-group"><label>Location</label>
            <input value="${esc(e.location)}" oninput="data.education[${i}].location=this.value;renderResume()" placeholder="City, Country">
          </div>
        </div>
      </div>`;
    container.appendChild(card);
  });
}

function addEducation() {
  data.education.push({ institution:'', period:'', degree:'', location:'' });
  renderEducationEditor(); renderResume();
}
function removeEducation(i) {
  data.education.splice(i, 1); renderEducationEditor(); renderResume();
}

/* ══════════════════════════════════════════════════
   CARD TOGGLE
══════════════════════════════════════════════════ */
function toggleCard(head) {
  const body = head.nextElementSibling;
  const icon = head.querySelector('.toggle-icon');
  body.classList.toggle('hidden');
  icon.classList.toggle('open');
}

/* ══════════════════════════════════════════════════
   PDF EXPORT — new window (no chrome headers)
══════════════════════════════════════════════════ */
function exportPDF() {
  const resumeHtml = document.getElementById('resume').innerHTML;
  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head>
  <meta charset="UTF-8">
  <title>Nabeel_Shehzad_Resume</title>
  <style>
    @page { size: 8.5in 11in; margin: 0; }
    * { margin:0; padding:0; box-sizing:border-box; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    body { font-family:'Times New Roman',Times,serif; font-size:10.5pt; line-height:1.24; color:#000; background:#fff; }
    #resume { width:8.5in; min-height:11in; padding:0.56in 0.83in 0.56in 0.83in; }
    .r-header{text-align:center;margin-bottom:6pt}
    .r-name{font-size:21pt;font-weight:bold;letter-spacing:.3px;margin-bottom:2pt}
    .r-contact{font-size:10pt;line-height:1.5}
    .r-contact a{color:#1155cc;text-decoration:underline}
    .r-section{margin-top:6pt}
    .r-section-title{font-size:10.5pt;font-weight:bold;text-transform:uppercase;letter-spacing:.4px;border-bottom:.75pt solid #000;padding-bottom:1pt;margin-bottom:4pt}
    .r-summary{text-align:justify;font-size:10pt;line-height:1.26}
    .r-skills{list-style:disc;padding-left:18pt}
    .r-skills li{font-size:10pt;line-height:1.24}
    .r-exp{margin-bottom:6pt}
    .r-row{display:flex;justify-content:space-between;align-items:baseline}
    .r-company{font-weight:bold;font-size:10.5pt}
    .r-date{font-size:10pt;white-space:nowrap}
    .r-jobtitle{font-style:italic;font-size:10pt}
    .r-loc{font-size:10pt}
    .r-bullets{list-style:disc;padding-left:18pt;margin-top:2pt}
    .r-bullets li{font-size:10pt;line-height:1.24;text-align:justify}
    .r-proj{margin-bottom:5pt}
    .r-proj-title{font-weight:bold;font-size:10.5pt}
    .r-edu-inst{font-weight:bold;font-size:10.5pt}
    .r-edu-degree{font-style:italic;font-size:10pt}
  </style>
  </head><body><div id="resume">${resumeHtml}</div>
  <script>window.onload=function(){window.print();setTimeout(()=>window.close(),1000)}<\/script>
  </body></html>`);
  win.document.close();
}

/* ══════════════════════════════════════════════════
   RESET
══════════════════════════════════════════════════ */
function resetData() {
  if (!confirm('Reset all data to defaults?')) return;
  location.reload();
}

/* ══════════════════════════════════════════════════
   INIT
══════════════════════════════════════════════════ */
function init() {
  // Populate personal info fields
  document.getElementById('f-name').value     = data.name;
  document.getElementById('f-location').value = data.location;
  document.getElementById('f-phone').value    = data.phone;
  document.getElementById('f-email').value    = data.email;
  document.getElementById('f-linkedin').value = data.linkedin;
  document.getElementById('f-github').value   = data.github;
  document.getElementById('f-summary').value  = data.summary;

  renderSkillsEditor();
  renderExperienceEditor();
  renderProjectsEditor();
  renderEducationEditor();
  renderResume();
}

init();
</script>
</body>
</html>
