<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 quyển sách
        $books = [
            [
                'name' => 'Sách 1',
                'author' => 'Tác giả 1',
                'price' => 100000,
                'stock' => 10,
                'description' => 'Mô tả cho sách 1',
                'image' => 'path/to/image1.jpg', // Đường dẫn đến ảnh
                'category' => 'Thể loại 1',
                'isbn' => '978-3-16-148410-0',
                'published_date' => '2021-01-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 2',
                'author' => 'Tác giả 2',
                'price' => 150000,
                'stock' => 5,
                'description' => 'Mô tả cho sách 2',
                'image' => 'path/to/image2.jpg',
                'category' => 'Thể loại 2',
                'isbn' => '978-3-16-148410-1',
                'published_date' => '2020-02-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 3',
                'author' => 'Tác giả 3',
                'price' => 200000,
                'stock' => 8,
                'description' => 'Mô tả cho sách 3',
                'image' => 'path/to/image3.jpg',
                'category' => 'Thể loại 3',
                'isbn' => '978-3-16-148410-2',
                'published_date' => '2019-03-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 4',
                'author' => 'Tác giả 4',
                'price' => 250000,
                'stock' => 12,
                'description' => 'Mô tả cho sách 4',
                'image' => 'path/to/image4.jpg',
                'category' => 'Thể loại 4',
                'isbn' => '978-3-16-148410-3',
                'published_date' => '2018-04-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 5',
                'author' => 'Tác giả 5',
                'price' => 300000,
                'stock' => 7,
                'description' => 'Mô tả cho sách 5',
                'image' => 'path/to/image5.jpg',
                'category' => 'Thể loại 5',
                'isbn' => '978-3-16-148410-4',
                'published_date' => '2017-05-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 6',
                'author' => 'Tác giả 6',
                'price' => 350000,
                'stock' => 15,
                'description' => 'Mô tả cho sách 6',
                'image' => 'path/to/image6.jpg',
                'category' => 'Thể loại 6',
                'isbn' => '978-3-16-148410-5',
                'published_date' => '2016-06-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 7',
                'author' => 'Tác giả 7',
                'price' => 400000,
                'stock' => 20,
                'description' => 'Mô tả cho sách 7',
                'image' => 'path/to/image7.jpg',
                'category' => 'Thể loại 7',
                'isbn' => '978-3-16-148410-6',
                'published_date' => '2015-07-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 8',
                'author' => 'Tác giả 8',
                'price' => 450000,
                'stock' => 18,
                'description' => 'Mô tả cho sách 8',
                'image' => 'path/to/image8.jpg',
                'category' => 'Thể loại 8',
                'isbn' => '978-3-16-148410-7',
                'published_date' => '2014-08-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 9',
                'author' => 'Tác giả 9',
                'price' => 500000,
                'stock' => 10,
                'description' => 'Mô tả cho sách 9',
                'image' => 'path/to/image9.jpg',
                'category' => 'Thể loại 9',
                'isbn' => '978-3-16-148410-8',
                'published_date' => '2013-09-01',
                'status' => 'available',
            ],
            [
                'name' => 'Sách 10',
                'author' => 'Tác giả 10',
                'price' => 550000,
                'stock' => 5,
                'description' => 'Mô tả cho sách 10',
                'image' => 'path/to/image10.jpg',
                'category' => 'Thể loại 10',
                'isbn' => '978-3-16-148410-9',
                'published_date' => '2012-10-01',
                'status' => 'available',
            ],
        ];

        // Lặp qua từng quyển sách và lưu vào cơ sở dữ liệu
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}