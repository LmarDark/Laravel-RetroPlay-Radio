FROM debian:bookworm-slim

RUN apt-get update && apt-get install -y \
    icecast2 \
    && rm -rf /var/lib/apt/lists/*

RUN useradd -m -d /var/lib/icecast2 -s /bin/false -g icecast icecast

RUN mkdir -p /var/log/icecast2 /var/run/icecast2 /var/lib/icecast2/logs \
    && chown -R icecast:icecast /etc/icecast2 /var/lib/icecast2 /var/log/icecast2 /var/run/icecast2

COPY icecast.xml /etc/icecast2/icecast.xml
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8000

USER icecast

CMD ["/start.sh"]
