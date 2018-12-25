<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'name' => "Đại Gia Gatsby",
            'author' => "F. Scott Fitzgerald",
            'intro' => "Là bức chân dung của “Thời đại Jazz” (Jazz Age, cái tên do chính Fitzgerald đặt cho thời kỳ 1918 - 1929), đại gia Gatsby nắm bắt vô cùng sâu sắc tinh thần của thế hệ cùng thời ông: những ám ảnh thường trực về thành đạt, tiền bạc, sang trọng, dư dật, hào nhoáng; song đồng thời là nỗi âu lo trước thói sùng bái vật chất vô độ và sự thiếu vắng đạo đức đang ngày một lên ngôi. Phất lên nhanh chóng từ chỗ “hàn vi”, Gatsby, nhân vật chính của câu chuyện, những tưởng sẽ có tất cả - tiền bạc, quyền lực, và sau rốt là tình yêu -, nhưng rồi ảo tưởng tình yêu đó tan vỡ thật đau đớn, theo sau là cái chết tức tưởi của Gatsby, để cuối cùng lập tức bị người đời quên lãng. Là lời cảnh tỉnh để đời của Scott Fitzgerald về cái gọi là “Giấc mơ Mỹ”, Đại gia Gatsby được ví như một tượng đài văn học, một cánh cửa cần mở ra cho những ai quan tâm tới văn học và lịch sử tinh thần nước Mỹ thời hiện đai. ",
            'quality' => "9/10",
            'image' => "https://i.pinimg.com/736x/b1/f8/21/b1f821bc431d852873aa0ec52891f920.jpg",
            "language" => "vi",
        ]);

        DB::table('books')->insert([
            'name' => "Không Chiến Zero Rực Lửa",
            'author' => "Naoki Hyakuta",
            'intro' => '"Các chiến cơ Zero thật sự rất đáng sợ. Zero nhanh đến mức không thể tin được. Sự chuyển động đó là thứ chúng tôi không thể dự đoán được, như ma trơi vậy. Mỗi lần chiến đấu, chúng tôi lại bị cảm giác yếu thế bao trùm. Thế nên, mới có mệnh lệnh rằng không để xảy ra không chiến với Zero. Chúng tôi biết việc chiến cơ tinh nhuệ mới của Nhật Bản được đặt tên mã là Zero. Cách đặt tên mới kỳ quặc làm sao. Zero nghĩa là không có gì cả, ấy vậy mà chiếc chiến cơ đó đã bỏ bùa chúng tôi với chuyển động không thể tin được. Tôi từng nghĩa đó chính là sự huyền bí của phương Đông. Chúng tôi đã từng nghĩ những phi công lái Zero không phải là người. Họ là ma quỷ. nếu không thì cũng là những cỗ máy chiến tranh."',
            'quality' => "9/10",
            'image' => "https://images.gr-assets.com/books/1488452562l/34447160.jpg",
            "language" => "vi",
        ]);

        DB::table('books')->insert([
            'name' => "Cô Gái Trên Tàu",
            'author' => "Paula Hawkins",
            'intro' => "Rachel mỗi ngày đều đón cùng một chuyến tàu điện. Mỗi ngày như thế, con tàu dừng lại ở một ga nhỏ, từ cửa sổ cô có thể nhìn thấy một cặp vợ chồng ngồi ăn sáng trên ban công. Dần dần, cô cảm thấy mình quen với họ. Và rồi một ngày kia, cô nhìn thấy một chuyện kinh hoàng. Chuyện chỉ xảy ra trong một phút rồi con tàu lại cất bánh đi tiếp, nhưng như thế cũng đủ rồi. Rachel không thể im lặng, cô phải nói cho cảnh sát biết những gì mình nhìn thấy và bị cuốn vào vòng xoáy của mọi việc. Liệu cô đã làm một việc tốt hay đã khiến mọi thứ rối rắm hơn?",
            'quality' => "9/10",
            'image' => "https://znews-photo.zadn.vn/w660/Uploaded/mzdqv/2015_12_28/Co_gai_tren_tau01.jpg",
            "language" => "vi",
        ]);
    }
}
