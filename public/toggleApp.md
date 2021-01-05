## Design a System which

Given a list of apps, how would you design a components which would:

* Display a list of apps
  * Every app has a status: active/inactive
  * Every app has a thumbnail
  
* Perform actions with the list such as
  * Toggle between showing and hiding inactive apps

## Extra Information

### What an app looks like

```js
{
  '@type': 'Pagely.Model.Apps.App',
  'id': 18799,
  'active': false,
  'accountId': 10411,
  'poolId': 29,
  'fileNode': 's213',
  'multisite': false,
  'multisiteType': '',
  'useSsl': false,
  'name': 'captcha.test.com_off',
  'dateDeleted': 1493232591,
  'dateAdded': 1469743768,
  'aliases': null,
  'config': { 'nginx': true },
}
```
