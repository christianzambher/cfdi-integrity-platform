# CFDI Integrity Platform - Backend

REST API built with CodeIgniter 4 for CFDI XML validation and analysis.

---

## Responsibilities

- XML processing
- XML sanitization
- CFDI metadata extraction
- SAT XSD validation
- Complement detection
- REST API endpoints

---

## Technologies

- PHP 8+
- CodeIgniter 4
- SimpleXML
- DOMDocument
- libxml

---

## Folder Structure

```text
backend/
│
├── app/
│   ├── Controllers/
│   ├── Services/
│   ├── Libraries/
│   └── Config/
│
├── storage/
│   └── xsd/
│
└── tests/
```

---

## Setup

```bash
composer install
```

---

## Run server

```bash
php spark serve
```

---

## Base URL

```text
http://localhost:8080
```

---

## Main Endpoint

### Validate XML

```http
POST /api/xml/validate
```

---

## XML Processing Flow

1. Upload XML file
2. Sanitize XML content
3. Validate XML syntax
4. Extract CFDI metadata
5. Detect CFDI complements
6. Validate SAT XSD schemas
7. Return structured response

---

## Supported Features

- UTF-8 BOM removal
- Encoding normalization
- Invalid XML character cleanup
- CFDI 4.0 parsing
- Timbre Fiscal Digital parsing
- XSD validation
