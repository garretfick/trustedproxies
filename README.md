TrustedProxies is a OctoberCMS plugin to configure which headers to trust
when handling requests. Tiis is useful when your site is behind a load
balancer that terminates the SSL connection (for example Heroku or some
AWS ELB configurations).

You can specify which header items to trust for the following items:

* forwarded for
* client IP
* client host
* client protocol
* client port
