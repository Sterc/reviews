# MODX Reviews
![Reviews version](https://img.shields.io/badge/version-1.2.0-brightgreen.svg) ![MODX Extra by Sterc](https://img.shields.io/badge/extra%20by-sterc-magenta.svg) ![MODX version requirements](https://img.shields.io/badge/modx%20version%20requirement-2.4%2B-blue.svg)

Install the Reviews extra for central review management. Each review contains the following fields: name, email, what Resource is being reviewed, rating 0-5, review content, active true/false. The extra becomes available in the 'Extras' menu after installing and comes with a Reviews-snippet to easily show one or more reviews on a page and has default-chunks out of the box, which you can of course change if you wish. 

## Example snippet call

```
{'!Reviews' | snippet : [
    'usePdoTools'   => true,
    'tpl'           => '@FILE elements/chunks/itemfenom.chunk.tpl',
    'tplWrapper'    => '@FILE elements/chunks/wrapperfenom.chunk.tpl',
    'tplEmpty'      => '@FILE elements/chunks/emptyfenom.chunk.tpl'
]}
```

## Parameters

| Parameter                  | Description                                                                 |
|----------------------------|------------------------------------------------------------------------------|
| id | [optional] The Resource ID of the page which is being reviewed (usually a product or service). Default: ID of the current Resource |
| reviews | [optional] Comma-seperated list of Review IDs to show. This overwrite the ID-parameter. |
| sort | [optional] The field on which to sort. Default: `createdon`. |
| sortDir | [optional] Sorting order: ASC/DESC. Default: `DESC`. |
| limit | [optional] Limit the amount of reviews to show. Default: 0 (unlimited) |
| tpl | [optional] The review item template. This can be a chunk , `@FILE` or `@INLINE` |
| tplWrapper | [optional] The review item wrapper-template. This can be a chunk , `@FILE` or `@INLINE` |
| tplEmpty | [optional] This tpl is shown when no results are found. This can be a chunk , `@FILE` or `@INLINE` |
| usePdoTools | [optional] Set to `true` to use pdoTools in the tpl's and enable fenom. (`@FILE` and `@INLINE` do not require this). Default: `false` |
| usePdoElementsPath | [optional] Set to `true` to use the system setting `pdotools_elements_path` as a base-path for the @FILE includes. If `false`, it uses `core/components/reviews/`. Default: `false` |

# Free Extra
This is a free extra and the code is publicly available for you to change. The extra is being actively maintained and you're free to put in pull requests which match our roadmap. Please create an issue if the pull request differs from the roadmap so we can make sure we're on the same page.

Need help? [Approach our support desk for paid premium support.](mailto:service@sterc.com)
