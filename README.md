# Ubuntu server adapter for Nanobox

## Description

Custom hosting endpoint adapter for [https://nanobox.io](Nanobox). If you have a single server available but still wish to use Nanobox for 
deployment, this app will perform the communication with the Nanobox dashboard.

We use the Symfony built-in server to run as it's actually a quite simple app, and we don't want to interfere with any
Nanobox services.

## Installation process

Install a basic Ubuntu server, with only the SSH server package selected. After this, 
follow the procedure below __(as root)__ to set up the adapter.

1. Clone the repository to `/srv/nanobox-endpoint`.
2. Copy [.env.sample](.env.sample) to `.env` and adjust the configuration values.
3. Perform all terminal commands listed below.

```bash
cd /srv/nanobox-endpoint
add-apt-repository ppa:ondrej/php
apt update
apt upgrade -y
apt install -y php7.1-cli php7.1-curl php7.1-zip php7.1-xml
php composer.phar install -o --no-dev
cp systemd.service /etc/systemd/system/nanobox-endpoint.service
systemctl daemon-reload
systemctl enable nanobox-endpoint
systemctl start nanobox-endpoint
```

### Configuration options

- `NANOBOX_ACCESS_TOKEN`: The access token needed to grant access to the Nanobox dashboard.
- `NANOBOX_EXTERNAL_IFACE`: The network interface which provides external access to the server e.g. eth0.
- `NANOBOX_INTERNAL_IFACE`: The network interface which has access to the internal network off the server e.g. eth1.
- `NANOBOX_EXTERNAL_IP`: The external IP address of the server.
- `NANOBOX_INTERNAL_IP`: The internal IP address of the server.
- `ENDPOINT_PORT`: The port on which the adapter should run e.g. 8000.
- `ENDPOINT_ID`: The id used to identify this provider in the Nanobox dashboard.
- `ENDPOINT_NAME`: The name used to identify this provider in the Nanobox dashboard.
