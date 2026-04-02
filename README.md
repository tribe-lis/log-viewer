# [Log Viewer](https://github.com/opcodesio/log-viewer)

![log-viewer-light-dark](https://user-images.githubusercontent.com/8697942/186705175-d51db6ef-1615-4f94-aa1e-3ecbcb29ea24.png)

## Installation

* Clone repository and navigate to it:

```shell
git clone https://github.com/tribe-lis/log-viewer.git && cd log-viewer
```

* Copy `.env.example` to `.env` and change `APP_TIMEZONE` and `LOG_DIR` according to your environment:

```text
APP_TIMEZONE=UTC
LOG_DIR=/var/www/*/var/log/data
```

* Build Docker image:

```shell
docker build -t log-viewer .
```

* Run container (change volume mappings according to your environment):

```shell
docker run -d --name=log-viewer --restart=always -p 8080:8080 -v /var/www:/var/www log-viewer
```

* Open `http://localhost:8080` to see logs.
