FROM node:17.7.1-alpine

WORKDIR /app

RUN apk update && \
    apk add \
      bash \
      bash-doc \
      bash-completion

RUN yarn install

EXPOSE 3000

CMD ["yarn", "start"]
