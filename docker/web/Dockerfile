FROM node:20.11.0-alpine

RUN apk update && \
    apk add git && \
    apk add --no-cache curl && \
    curl -o- -L https://yarnpkg.com/install.sh | sh && \
    yarn global add @vue/cli

WORKDIR /app

CMD ["/bin/ash"]
