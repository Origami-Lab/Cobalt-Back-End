# Deploy API Platform on Scaleway K8S

## Create Cluster

-   Create a project credentials
-   Create a K8S cluster with Nginx Ingress
-   Download kubernetes configfile
-   Create a container registry

## Create a database instance of MySQL8

Create a MySQL 8 instance

## Build and deploy api-platform

### Build images

```bash
docker-compose -f docker-compose.yml -f docker-compose.prod.yml build --no-cache
```

### Push images

```bash
# 1. Login docker registry
docker login rg.fr-par.scw.cloud/image-registry -u nologin -p $SCW_SECRET_KEY

# 2. Tag images
docker tag cobalt-back-end_php:latest rg.fr-par.scw.cloud/cobalt/cobalt-back-end_php:latest
docker tag cobalt-back-end_caddy:latest rg.fr-par.scw.cloud/cobalt/cobalt-back-end_caddy:latest
docker tag cobalt-back-end_pwa:latest rg.fr-par.scw.cloud/cobalt/cobalt-back-end_pwa:latest

# 3. Push images
docker push rg.fr-par.scw.cloud/cobalt/cobalt-back-end_php:latest
docker push rg.fr-par.scw.cloud/cobalt/cobalt-back-end_caddy:latest
docker push rg.fr-par.scw.cloud/cobalt/cobalt-back-end_pwa:latest
```

### Config Helm chart

Copy `helm/api-platform/values.yaml` to `helm/api-platform/values-dev.yaml` and update it

-   Image repository
-   Ingress host
-   Database URL

### Deploy

```bash
# 1. Update dependency
helm dependency update helm/api-platform

# 2. Deploy
helm install cobalt helm/api-platform --namespace=default -f helm/api-platform/values-dev.yaml

# 3. Upgrade
helm upgrade cobalt helm/api-platform --namespace=default -f helm/api-platform/values-dev.yaml

# 4. Uninstall
helm uninstall cobalt
```

## Setup load balancer

### Create a Resevered IP

This IP is created only one time and used for all Loadbalancer services

See: <https://www.scaleway.com/en/docs/tutorials/lb-ingress-controller/>

> check `$SCW_DEFAULT_PROJECT_ID` in credential tab of project overview
> `$SCW_SECRET_KEY` is secret key you created earlier
> `$SCW_DEFAULT_REGION` = `fr-par`

```bash
curl -X POST "https://api.scaleway.com/lb/v1/regions/$SCW_DEFAULT_REGION/ips" -H "X-Auth-Token: $SCW_SECRET_KEY" -H "Content-Type: application/json" \
-d "{\"project_id\":\"$SCW_DEFAULT_PROJECT_ID\"}" | jq -r .ip_address
```

### Create a Loadbalancer service with created IP

```bash
# 1. Create service
kubectl apply -f k8s/lb.yaml

# 2. Update IP
kubectl patch svc nginx-ingress --type merge --patch '{"spec":{"loadBalancerIP": "<IP>","type":"LoadBalancer"}}
```

## Setup SSL

Reference https://cert-manager.io/docs/tutorials/acme/ingress

### Install cert-manager

```bash
kubectl apply -f https://github.com/jetstack/cert-manager/releases/download/v1.5.3/cert-manager.yaml

kubectl apply -f k8s/staging-issuer.yaml
kubectl apply -f k8s/production-issuer.yaml
```

### Issue certificate using Staging API

The Let’s Encrypt production issuer has very strict rate limits. When you are experimenting and testing, it is very easy to hit those limits, and confuse rate limiting with errors in configuration or operation.

#### Update Ingress configration in helm/api-platform/values-dev.yaml with staging-issuer and test it first and then change to production-issuer.

```yaml
annotations:
    kubernetes.io/ingress.class: "nginx"
    cert-manager.io/issuer: "letsencrypt-prod"

tls:
    - secretName: cobalt-api-tls
      hosts:
          - [DOMAIN NAME]
```

#### Update deployment

```bash
helm upgrade cobalt helm/api-platform --namespace=default -f helm/api-platform/values-dev.yaml
```
