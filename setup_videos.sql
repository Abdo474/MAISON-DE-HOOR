-- Create videos table with BLOB storage
CREATE TABLE IF NOT EXISTS videos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL,
    video_data LONGBLOB NOT NULL,
    mime_type VARCHAR(255) DEFAULT 'video/mp4',
    file_size BIGINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add video_id column to collections table
ALTER TABLE collections ADD COLUMN video_id BIGINT UNSIGNED NULL;

-- Add foreign key constraint
ALTER TABLE collections ADD CONSTRAINT collections_video_id_foreign 
FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE SET NULL;

-- Update collections with video_id references (assuming videos will be inserted)
-- Insert three videos (you'll upload the actual video data via the UI later)
INSERT INTO videos (name, filename, mime_type, file_size, video_data) VALUES
('The Tatreez Collection Video', 'tatreez-collection-video.mp4', 'video/mp4', 0, 0x0),
('The Ramadan Collection Video', 'ramadan-collection-video.mp4', 'video/mp4', 0, 0x0),
('Double Exposure Video', 'double-exposure-video.mp4', 'video/mp4', 0, 0x0);

-- Link collections to videos
UPDATE collections SET video_id = 1 WHERE slug = 'tatreez-collection';
UPDATE collections SET video_id = 2 WHERE slug = 'ramadan-collection';
UPDATE collections SET video_id = 3 WHERE slug = 'double-exposure';

-- Display all collections with their videos
SELECT c.id, c.name, c.slug, c.video_id, v.filename FROM collections c
LEFT JOIN videos v ON c.video_id = v.id;
