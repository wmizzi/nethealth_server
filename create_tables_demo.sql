CREATE TABLE test_info (
			id SMALLINT NOT NULL AUTO_INCREMENT,
    		timestamp TIMESTAMP NOT NULL,
            lat FLOAT(7,4) NOT NULL,
            lon FLOAT(7,4) NOT NULL,
    		ip VARCHAR(16) NOT NULL,
            traceroute VARCHAR(255) NOT NULL,
    		PRIMARY KEY (id)
    		);

CREATE TABLE udp_dl_420p (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_dl_720p (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_dl_1080p (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_dl_4k (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_2way_gaming (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            latency FLOAT(6,5) NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_2way_highvoip (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            latency FLOAT(6,5) NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_2way_lowvoip (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            latency FLOAT(6,5) NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_ul_svc (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_ul_hdvc (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE udp_ul_ss (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );

CREATE TABLE tcp (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            download FLOAT(12,3) NOT NULL,
            upload FLOAT(12,3) NOT NULL,
            PRIMARY KEY (id)
            );
