FROM centos:7

ENV version "0.0.1-alpha"
LABEL maintainer="kellen@bcsengineering.com"
LABEL vendor="BCSE, LLC. dba IDM Engineering"
LABEL com.idmengineering.project="sp-demo"
LABEL com.idmengineering.version=${version}
LABEL com.idmengineering.is-production="false"

RUN yum install https://repo.ius.io/ius-release-el7.rpm \
    https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm -y

RUN yum update -y
RUN yum install httpd -y
RUN yum install mod_php74 php74-cli php74-fpm \
    php74-mysqlnd php74-devel php74-gd php74-mbstring \
    php74-xml php74-bcmath php74-json -y
COPY etc/httpd/conf.d/00_vhost.conf /etc/httpd/conf.d

RUN curl -d "platform=CentOS_7" -X POST https://shibboleth.net/cgi-bin/sp_repo.cgi > /etc/yum.repos.d/shibboleth.repo
RUN yum-config-manager --enable shibboleth
RUN yum update -y
RUN yum install shibboleth -y
COPY etc/shibboleth/* etc/shibboleth
RUN cp /etc/shibboleth/shibd-redhat /etc/init.d/shibd 
RUN chmod u+x /etc/init.d/shibd

RUN yum install mod_ssl openssl -y

COPY app /var/www/html
COPY start.sh /
CMD ["/bin/sh /start.sh"]
EXPOSE 80 443