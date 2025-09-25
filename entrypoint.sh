

php artisan serve --host=0.0.0.0 --port=8000 &

APP_PID=$!

while true; do
    WAIT_TIME=$((RANDOM % 600 + 300))
    sleep $WAIT_TIME

    curl -s http://localhost:8000 > /dev/null

    if ! kill -0 "$APP_PID" 2>/dev/null; then
        break
    fi
done
