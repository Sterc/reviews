# MODX Reviews
![Reviews version](https://img.shields.io/badge/version-1.0.0-red.svg) ![MODX Extra by Sterc](https://img.shields.io/badge/checked%20by-Gauke-blue.svg) ![MODX version requirements](https://img.shields.io/badge/modx%20version%20requirement-2.4%2B-brightgreen.svg)

## Snippets

**Voorbeeld snippet call:**

```
{'!Reviews' | snippet : [
	'usePdoTools' 	=> true,
    'tpl'			=> '@FILE elements/chunks/itemfenom.chunk.tpl',
    'tplWrapper'	=> '@FILE elements/chunks/wrapperfenom.chunk.tpl',
    'tplEmpty'		=> '@FILE elements/chunks/emptyfenom.chunk.tpl'
]}
```

**Beschikbare parameters:**

| Parameter                  | Omschrijving                                                                 |
|----------------------------|------------------------------------------------------------------------------|
| id | De ID van de pagina waar de reviews van getoond moeten worden. Standaard de huidige pagina ID. |
| reviews | De ID's van de reviews die getoond moeten worden, meerdere ID's scheiden met een komma. Deze parameter overschrijft de `id` parameter. |
| sort | De database kolom waarop gesorteerd word. Standaard `createdon`. |
| sortDir | De ASC/DESC volgorde waarop gesorteerd word. Standaard `DESC`. |
| limit | Het aantal reviews die getoond mogen worden. Standaard `0`, indien `0` dan worden alle reviews getoond. |
| tpl | De template van een review item. Dit kan een chunknaam, `@FILE` of `@INLINE` zijn. |
| tplWrapper | De tpl van de review items. Dit kan een chunknaam, `@FILE` of `@INLINE` zijn. |
| tplEmpty | De tpl indien er geen review items zijn. Dit kan een chunknaam, `@FILE` of `@INLINE` zijn. |
| usePdoTools | Indien `true` dan word pdoTools gebruikt voor de tpl's en is fenom mogelijk (ook `@FILE` en `@INLINE` zijn mogelijk zonder pdoTools). Standaard `false`. |
| usePdoElementsPath | Indien `true` dan worden `@FILE` tpl's gebruikt vanuit de map die in de `pdotools_elements_path` systeem instelling ingesteld is. Anders word het de `core/components/reviews/` map gebruikt. Standaard `false`. |