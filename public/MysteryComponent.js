import React, { useState, Fragment } from 'react';
import { CopyToClipboard } from 'react-copy-to-clipboard';
import IconButton from '@material-ui/core/IconButton';
import CopyIcon from '@material-ui/icons/FileCopyOutlined';
import Snackbar from '@material-ui/core/Snackbar';
import Tooltip from '@material-ui/core/Tooltip';
import SnackbarContent from '@material-ui/core/SnackbarContent';

import { string, node } from 'prop-types';
import scss from './CopyButton.scss';

const MysteryComponent = ({
  message, text, tooltip, color, size, fontSize, children,
}) => {
  const [open, setOpen] = useState(false);

  const handleClose = (event, reason) => {
    if (reason === 'clickaway') {
      return;
    }
    setOpen(false);
  };

  return (
    <Fragment>
      <CopyToClipboard
        text={text}
        onCopy={() => {
          setOpen(true);
        }}
      >
        {
          children || (
            <IconButton
              size={size || 'medium'}
              color={color || 'primary'}
              onClick={(e) => { e.preventDefault(); e.stopPropagation(); }}
            >
              {
                tooltip
                  ? (
                    <Tooltip
                      title={tooltip}
                      placement="top"
                    >
                      <CopyIcon
                        fontSize={fontSize || 'small'}
                      />
                    </Tooltip>
                  ) : (
                    <CopyIcon
                      fontSize={fontSize || 'small'}
                      className={scss.SVGIcon}
                    />
                  )
              }
            </IconButton>
          )
        }
      </CopyToClipboard>
      <Snackbar
        open={open}
        className={scss.successBanner}
        autoHideDuration={3000}
        onClose={handleClose}
      >
        <SnackbarContent
          message={message}
        />
      </Snackbar>
    </Fragment>
  );
};

MysteryComponent.propTypes = {
  children: node,
  color: string,
  fontSize: string,
  message: string,
  size: string,
  text: string.isRequired,
  tooltip: string,
};

export default MysteryComponent;
