# Resume Builder

A single-file interactive resume builder built with PHP and vanilla JavaScript. Edit every section of your resume and see changes reflected instantly in a live preview. Export a clean, formatted PDF with one click.

---

## Features

- **Live preview** — every keystroke updates the resume in real time
- **Section editor** — dedicated editor panels for Personal Info, Summary, Skills, Experience, Projects, and Education
- **Add / remove entries** — add or delete experience entries, projects, education records, skill categories, and individual bullet points
- **Zoom controls** — zoom the preview in or out without affecting the export
- **PDF export** — opens a clean print window with no browser headers or footers, auto-closes after printing
- **Single file** — the entire app is one `index.php` file with no dependencies or build step

---

## Tech Stack

| Layer     | Technology                        |
|-----------|-----------------------------------|
| Backend   | PHP (serves the HTML shell)       |
| Frontend  | Vanilla JavaScript (no framework) |
| Styling   | Pure CSS (CSS variables + Flexbox)|
| PDF       | Browser native print (`window.print`) |

---

## Getting Started

### Requirements

- PHP 7.4 or higher
- Any modern browser (Chrome recommended for best PDF output)

### Run locally

```bash
cd /path/to/Resume
php -S localhost:8765
```

Then open **http://localhost:8765** in your browser.

---

## How to Use

### Editing

1. Click a section in the left sidebar (Personal Info, Summary, Skills, etc.)
2. Edit the fields in the middle panel
3. Watch the resume preview update instantly on the right

### Adding entries

- Inside Experience, Projects, or Education — click **+ Add Experience / Project / Education**
- Inside a job or project — click **+ Add bullet** to add a new bullet point
- Inside Skills — click **+ Add Skill Category**

### Removing entries

- Click the **✕** button on any card header to remove that entry
- Click the **✕** icon next to any bullet to remove that line

### Collapsing cards

Click the card header to collapse or expand it — useful when editing a section with many entries.

### Zoom

Use the **−** and **+** buttons in the preview toolbar to zoom the preview. Zoom only affects the on-screen view, not the exported PDF.

---

## Exporting as PDF

1. Click **↓ Export PDF** in the top-right toolbar
2. A clean print window opens automatically
3. In the browser print dialog:
   - **Destination** → Save as PDF
   - **Paper size** → Letter (8.5 × 11 in)
   - **Margins** → None
   - **Headers and footers** → unchecked
4. Click **Save**

> Chrome gives the cleanest PDF output. The print window closes automatically after printing.

---

## Project Structure

```
Resume/
├── index.php        # Entire application (editor + preview + export)
└── README.md        # This file
```

---

## Customization

All resume data is initialized in the `data` object at the top of the `<script>` block inside `index.php`. You can edit default values there directly, or use the UI to make changes at runtime.

Resume typography uses **Times New Roman** to match a classic professional format. Styles for the resume paper are isolated under the `#resume` selector and the `@media print` block, so editor UI changes never affect the exported PDF.
