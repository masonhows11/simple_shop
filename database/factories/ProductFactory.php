<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'گوشی سامسنوگ A55','گوشی ایفون 14','گوشی ایفون 13','گوشی نوبیا','لپ تاپ دل 15','یخچال ساید ال جی','یخچال ساید امرسان','هندسفری','کوله پشتی کتلپیلار','کفش مجلسی ورنی','مانتو مجلسی','ساعت شیاومی'
            ]),
            'description' => "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.",
            'price' => fake()->randomElement([
                '10000','12000','25000','30000','55000'
            ]),
            'quantity' => fake()->randomDigitNotNull,
        ];
    }
}
