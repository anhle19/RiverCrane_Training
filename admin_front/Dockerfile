# Chọn base image
FROM node:lts-alpine as build-stage

# Thiết lập thư mục làm việc trong container
WORKDIR /app

# Copy 'package.json' và 'package-lock.json' (nếu có)
COPY package*.json ./

# Cài đặt các phụ thuộc của project
RUN npm install

# Copy toàn bộ mã nguồn của project vào container
COPY . .

# Build ứng dụng Vue.js cho production
RUN npm run build

# Chọn base image cho production
FROM nginx:stable-alpine as production-stage

# Copy thư mục 'dist' từ build-stage vào thư mục phục vụ web của nginx
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Mở cổng 80 để có thể truy cập nginx
EXPOSE 80

# Chạy nginx với cấu hình mặc định
CMD ["nginx", "-g", "daemon off;"]