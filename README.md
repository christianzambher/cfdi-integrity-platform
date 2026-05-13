# CFDI Integrity Platform

CFDI Integrity Platform is a fullstack application focused on validating, sanitizing, and analyzing CFDI XML documents issued by the SAT.

The platform detects malformed XML structures, encoding problems, invalid characters, CFDI metadata, namespaces, and SAT XSD compliance.

---

## Live Demo

[![Frontend](https://img.shields.io/badge/Frontend-Vercel-000?style=for-the-badge&logo=vercel)](https://cfdi-integrity-platform.vercel.app)

[![Backend](https://img.shields.io/badge/Backend-Railway-0B0D0E?style=for-the-badge&logo=railway)](https://cfdi-integrity-platform-production.up.railway.app)

---

## Architecture

- Frontend: Vue 3 + Vite + TailwindCSS
- Backend: CodeIgniter 4 REST API
- Infrastructure:
  - Frontend deployed on Vercel
  - Backend deployed on Railway using Docker

---

## Features
- XML upload and processing
- XML syntax validation
- XML sanitization
- CFDI XML validation
- XSD schema validation
- SAT metadata extraction
- UTF-8 BOM detection and removal
- Encoding normalization
- Invalid character cleanup
- CFDI metadata extraction
- SAT CFDI XSD validation
- CFDI complement detection
- Vue.js frontend
- CodeIgniter 4 REST API backend
- Drag & Drop upload
- Real-time validation results
- Modular dashboard UI
- Multi-environment support
- Dockerized backend deployment

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
    "uuid": "EEF31111-B222-433A-8A44-57CFF335555",
    "emisor": "SBM090813PP4",
    "receptor": "ABCD001122ABC",
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
