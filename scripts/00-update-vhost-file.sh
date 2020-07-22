#!/bin/bash

set -e

DEFAULT_VHOST='/etc/nginx/sites-available/default.conf'

# Configure apache with "SYMFONY_..."  environements variables
/bin/sed -i "s/APP_ENV dev/APP_ENV $APP_ENV/" $DEFAULT_VHOST

_ENV_VARS=(
PHP_ERRORS_STDERR
TRUSTED_PROXIES
APP_SECRET
APP_HOST
SAML_IDP_HOST
SAML_USERNAME_ATTRIBUTE
SAML_IDP_X509CERT
SAML_SP_X509CERT
SAML_SP_PRIVATEKEY
SAML_ALWAYS_USE_DEFAULT_TARGET_PATH
SAML_DEFAULT_TARGET_PATH
MONOLOG_MAIN_PATH
CORS_ALLOW_ORIGIN
ERROR_REDIRECT
ERROR_AUTHORIZATION_REDIRECT_HOST
ERROR_DEFAULT_REDIRECT_HOST
BACKEND_USER_ROLE
BACKEND_HOST
BACKEND_HEADERS
HEIMDALL_HOST
HEIMDALL_API_KEY

)

_FILTER=DUMMY_FILTER
for i in ${_ENV_VARS[@]}; do
        _FILTER="$_FILTER\|${i}"
done

/usr/bin/env | grep -i "^\($_FILTER\)" | /bin/sed -r 's/([0-9A-Z_]*)=(.*)/fastcgi_param \1 '\''\2'\'';/g' > /tmp/replace_env.txt
/bin/sed -i '/# fastcgi_param SYMFONY_VARS/ {
  r /tmp/replace_env.txt
  d
}' $DEFAULT_VHOST
/bin/rm /tmp/replace_env.txt

