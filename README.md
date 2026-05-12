# CFDI Integrity Platform

CFDI Integrity Platform is a fullstack application focused on validating, sanitizing, and analyzing CFDI XML documents issued by the SAT.

The platform detects malformed XML structures, encoding problems, invalid characters, CFDI metadata, namespaces, and SAT XSD compliance.

---

## Features
- XML upload and processing
- XML syntax validation
- XML sanitization
- UTF-8 BOM detection and removal
- Encoding normalization
- Invalid character cleanup
- CFDI metadata extraction
- SAT CFDI XSD validation
- CFDI complement detection
- Vue.js frontend
- CodeIgniter 4 REST API backend

---

## Tech Stack

### Frontend

- Vue 3
- Vite
- Axios
- TailwindCSS

### Backend

- PHP 8+
- CodeIgniter 4
- DOMDocument
- SimpleXML
- libxml

---

## Project Structure

```text
cfdi-integrity-platform/
│
├── backend/
│   ├── app/
│   ├── storage/
│   └── tests/
│
├── frontend/
│   ├── src/
│   └── public/
│
└── README.md
```

## Local Installation

### Clone repository

```bash
git clone https://github.com/your-user/cfdi-integrity-platform.git
```

---

# Backend setup

```bash
cd backend
composer install
php spark serve
```

Backend runs on:
```text
http://localhost:8080
```
---

# Frontend setup

```bash
cd frontend
npm install
npm run dev
```

Frontend runs on:

```text
http://localhost:5173
```

---

## API Endpoints

### Health check

```http
GET /api/health
```

---

### XML validation

```http
POST /api/xml/validate
```

Request:

```text
multipart/form-data
```

Field:

```text
xmlFile
```

---

## Example Response

```json
{
  "valid": true,
  "warnings": [],
  "metadata": {
    "version": "4.0",
    "uuid": "EEF34D92-B636-414A-8AC1-57CFF33AB345",
    "emisor": "SBM090813PP4",
    "receptor": "ZAHC931222FE1",
    "total": "8585.36",
    "fecha": "2025-12-12T12:32:30"
  },
  "xsd_validation": {
    "valid": true,
    "errors": []
  }
}
```

---

## Current Capabilities

- XML structure validation
- CFDI namespace parsing
- Timbre Fiscal Digital parsing
- Complement detection
- SAT schema validation
- XML sanitization pipeline

---

## License

MIT
