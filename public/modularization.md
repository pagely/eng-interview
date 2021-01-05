## Design a System which

Given a list of certificates, how would you design a components which would:

* Display a list of certificates
  * Every Certificate displays basic information about it (ie, expiration date)
  * Every Certificate has a link to view more
  * Every Certificate has actions to delete and edit certificate
  
* Perform actions with the list such as
  * Create a new certificate
  * Switch between displaying dates in local timezone and GMT

## Extra Information

### What a certificate looks like

```js
propTypes = {
  activeCount: PropTypes.number.isRequired,
  alternateNames: PropTypes.array.isRequired,
  certType: PropTypes.string.isRequired,
  created: PropTypes.string.isRequired,
  domains: PropTypes.array.isRequired,
  expires: PropTypes.string.isRequired,
  id: PropTypes.number.isRequired,
  issuedBy: PropTypes.string.isRequired,
  issuerData: PropTypes.shape({
    country: PropTypes.string,
    email: PropTypes.string,
    locality: PropTypes.string,
    name: PropTypes.string,
    organization: PropTypes.string,
    state: PropTypes.string,
  }).isRequired,
  startDate: PropTypes.string.isRequired,
  subject: PropTypes.string,
  subjectData: PropTypes.shape({
    country: PropTypes.string,
    email: PropTypes.string,
    locality: PropTypes.string,
    name: PropTypes.string,
    organization: PropTypes.string,
    state: PropTypes.string,
  }).isRequired,
  updated: PropTypes.string,
};
```
