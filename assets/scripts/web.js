const express = require('express');
const axios = require('axios');
const cors = require('cors');
require('dotenv').config();

const app = express();
const port = 3000;

app.use(cors());
app.use(express.static('assets'));

// Xuất ra kq xem API chạy chưa
app.get('/', (req, res) => {
    res.send('API: OK');
});

// Lấy thống tin anime qua id: localhost:3000/anime/info?id= Nhập id vào
app.get('/anime/info', async (req, res) => {
    const animeId = req.query.id;
    const url = `https://api.myanimelist.net/v2/anime/${animeId}?fields=id,title,main_picture,synopsis,genres`;

    try {
        const response = await axios.get(url, {
            headers: {
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching anime info:', error);
        res.status(500).json({ message: 'Error fetching anime info' });
    }
});

// Lấy thống tin anime qua cả id: localhost:3000/( sau dấu ngoặc ở chữ get)?q= Tên anime // Hoặc ?id= như ở trên
app.get('/anime/search', async (req, res) => {
    const query = req.query.q;
    const offset = req.query.offset || 0; // Phân trang bắt đầu từ vị trí này
    const url = `https://api.myanimelist.net/v2/anime?q=${query}&limit=20&offset=${offset}&fields=id,title,main_picture`;

    try {
        const response = await axios.get(url, {
            headers: {
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error searching for anime:', error);
        res.status(500).json({ message: 'Error searching for anime' });
    }
});
//tự động gợi ý khi tìm kiếm
app.get('/anime/suggest', async (req, res) => {
    const query = req.query.q;
    const limit = req.query.limit || 10; // Sử dụng giá trị mặc định nếu không có tham số limit
    const fields = req.query.fields || 'id,title,main_picture'; // Trường cần lấy

    // Kiểm tra đầu vào
    if (!query) {
        return res.status(400).json({ message: 'Missing search query' });
    }

    const url = `https://api.myanimelist.net/v2/anime?q=${encodeURIComponent(query)}&limit=${limit}&fields=${fields}`;

    try {
        const response = await axios.get(url, {
            headers: {
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        console.log(response.data); // Ghi ra dữ liệu để kiểm tra
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching anime suggestions:', error.response ? error.response.data : error.message);
        res.status(500).json({ message: 'Error fetching anime suggestions' });
    }
});


// Gợi ý anime. Cứ nhập loccalhost:3000/anime/recommendations là nó ra
app.get('/anime/recommendations/upcoming', async (req, res) => {
    const offset = req.query.offset || 0;
    const url = `https://api.myanimelist.net/v2/anime/ranking?ranking_type=upcoming&limit=20&offset=${offset}`;

    try {
        const response = await axios.get(url, {
            headers: {                                                                                  
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching anime recommendations:', error);
        res.status(500).json({ message: 'Error fetching anime recommendations' });
    }
});
app.get('/anime/season', async (req, res) => {
    const year = req.query.year; // Lấy giá trị year từ query parameters
    const season = req.query.season; // Lấy giá trị season từ query parameters
    const offset = req.query.offset || 0;

    // Kiểm tra xem year và season có được cung cấp không
    if (!year || !season) {
        return res.status(400).json({ message: 'Year and season are required' });
    }

    const url = `https://api.myanimelist.net/v2/anime/season/${year}/${season}?limit=20&offset=${offset}`;

    try {
        const response = await axios.get(url, {
            headers: {                                                                                  
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching anime recommendations:', error);
        res.status(500).json({ message: 'Error fetching anime recommendations' });
    }
});

app.get('/anime/recommendations/bypopularity', async (req, res) => {
    const offset = req.query.offset || 0;
    const url = `https://api.myanimelist.net/v2/anime/ranking?ranking_type=bypopularity&limit=20&offset=${offset}`;

    try {
        const response = await axios.get(url, {
            headers: {                                                                                  
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching anime recommendations:', error);
        res.status(500).json({ message: 'Error fetching anime recommendations' });
    }
});

// Xem anime review. Tương tự với gợi ý anime
app.get('/anime/reviews', async (req, res) => {
    const animeId = req.query.id;
    const offset = req.query.offset || 0; // Phân trang bắt đầu từ vị trí này
    const url = `https://api.myanimelist.net/v2/anime/${animeId}/reviews?limit=20&offset=${offset}`;

    try {
        const response = await axios.get(url, {
            headers: {
                'X-MAL-CLIENT-ID': process.env.MAL_CLIENT_ID,
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching anime reviews:', error);
        res.status(500).json({ message: 'Error fetching anime reviews' });
    }
});
// Đáp ứng phần mở rộng của recommendations


// Access Token không động thằng này
app.get('/token', async (req, res) => {
    const code = req.query.code; // Mã xác thực từ query string
    const tokenUrl = 'https://myanimelist.net/v1/oauth2/token';

    try {
        const response = await axios.post(tokenUrl, null, {
            params: {
                client_id: process.env.MAL_CLIENT_ID,
                client_secret: process.env.MAL_CLIENT_SECRET,
                code: code,
                redirect_uri: process.env.REDIRECT_URI,
                grant_type: 'authorization_code',
            }
        });
        res.json(response.data);
    } catch (error) {
        console.error('Error exchanging code for token:', error);
        res.status(500).send('Error exchanging code for token');
    }
});


//Trả ra port đang chạy
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
