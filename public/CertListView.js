import React, { useEffect, useState } from 'react';
import PropTypes from 'prop-types';

/*
  * Display a list of certificates
  * Every Certificate displays basic information about it (ie, expiration date)
  * Every Certificate has a link to view more
  * Every Certificate has actions to delete and edit certificate
  
  Perform actions with the list such as
  * Create a new certificate
  * upload new certificate
  * Filter by certificate active status
*/

const certificatePropTypes = {
  active: PropTypes.bool,
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

const CertList = () => {
  return ();
}

const CertListView = () => {
  return ();
}

CertListView.propTypes = {
  certs: PropTypes.arrayOf(shape({
    ...certificatePropTypes
  }))
}

export default CertListView;
