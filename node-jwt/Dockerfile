FROM node:20-bullseye
RUN apt install -y make gcc g++
WORKDIR /app
EXPOSE 3555

# Transfére du fichier package JSON - dépandence
 COPY ./package-lock.json package-lock.json
COPY ./package.json package.json

# Transfére les fichiers du project
COPY . .

RUN npm install
RUN npm install -g nodemon
CMD ["npm", "start"]
