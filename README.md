# Demo Shibboleth SP Docker Image

# Shibboleth Set up

There is some degree of configuration of the Shibboleth Service Provider (SP) software in order to functionally integrate with a SAML Identity Provider (IdP).

## `idpdev` Integration

This very early version of the demo relies upon a static integration with one of the IDM Engineering demo IdPs. Our test IdP at `https://idpdev.idmintegration.com/idp/shibboleth` has an integration formed with this container image when ran on localhost, and will release the following attributes:

- cn
- eppn
- givenName
- mail
- sn
- uid

when you use the test account credentials (u: foo / pw: bar). 

# Roadmap

- [x] Alpha
    - [x] Self-signed SSL certificate for HTTPS
    - [x] Statically defined integration with `idpdev.idmintegration.com`
    - [x] runs only on `localhost`
- [ ] Beta (?)
    - [ ] Support for Azure Container Instances
    - [ ] Support for valid third-party SSL certificate with Let's Encrypt
    - [ ] Support for arbitrary Identity Provider integrations
    - [ ] Inclusion of Shibboleth Embedded Discovery Service (EDS)
    - [ ] Dynamic integration with Demo IDP

TODO:
- [ ] Look at using [docker config templates](https://docs.docker.com/engine/swarm/configs/)