<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('prod_no');
            $table->enum('category', ['Milk Tea', 'Frappe', 'Fruit Tea', 'Hot Drinks', 'Cold Drinks', 'Lemonade', 'Soya Drink', 'Soda Pops', 'Food']);
            $table->string('prod_name', 40);
            $table->text('prod_description');
            $table->date('prod_date');
            $table->decimal('prod_price', 10, 2);
            $table->text('prod_img')->nullable();
            $table->string('status', 20)->default('Available');
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Almond Milk Tea',
                'prod_description' => 'Almond milk and black tea are a match made in heaven.\r\n\r\nThe combination first became popular with tea drinkers who had to avoid milk for dietary reasons. However, the explosion of the boba milk tea fashion quickly brought this delicious tea to conquer a much wider stage.\r\n\r\nNow, almond milk tea is one of the most popular flavors for bubble tea, especially among black tea lovers.\r\n\r\nMaking almond milk tea at home is easy. This is our tried and tested boba almond tea recipe.',
                'prod_date' => '2022-04-14',
                'prod_price' => 80.00,
                'prod_img' => 'product-625b6be85eee85.21558417.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Hazelnut Milk Tea',
                'prod_description' => 'The color of this is more of a tan with no trace of the milk separating.\r\n\r\nThis drink has an aroma of lemon curd with subtle hints of hazelnut flour. \r\n\r\nThe flavor of this drink is of sour milk and black tea. There is a citrus and berry note that is in the back like of blueberry and navel orange but its hardly noticeable.  There is no trace or flavor of hazelnut in this in any way!\r\n\r\nIt does make you salivate and has a dry after taste like of a tart green apple and is probable from malic acid.',
                'prod_date' => '2022-04-15',
                'prod_price' => 85.00,
                'prod_img' => 'product-625b6e1dccfcb3.39672856.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Coffee',
                'prod_description' => 'Our coffee is undoubtedly the best way to start your day, and our delicious, fresh breakfast and lunch options will satisfy your appetite.\r\n\r\nGreat coffee starts with great beans.\r\n\r\nWe use an exclusive blend of the highest quality coffee beans, then our baristas work their magic to make your coffee exactly how you like it.',
                'prod_date' => '2022-04-15',
                'prod_price' => 60.00,
                'prod_img' => 'product-625b6efd264ae4.41136895.png',
                'status' => 'Not Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Iced Coffee',
                'prod_description' => 'Drinking iced coffee is a real refreshment compared to hot coffee. You\'ll never burn your tongue on that really hot coffee again, which always means that everything you put in your mouth for the rest of the week has a slightly crazy taste. You do not have to wait for the coffee to reach a drinkable temperature, you can enjoy the coffee immediately!',
                'prod_date' => '2022-04-16',
                'prod_price' => 70.00,
                'prod_img' => 'product-625b70a949a713.88633739.png',
                'status' => 'Not Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Milk Macha',
                'prod_description' => 'Machiastos have a very speciality drink',
                'prod_date' => '2023-09-30',
                'prod_price' => 39.00,
                'prod_img' => 'product-625b72c9149e54.18982836.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Black Forest',
                'prod_description' => 'A black forest chocolate you will go crazy for. Nothing goes better with a night in than tart cherries, dark chocolate, and airy whipped cream. Everyone will be begging for another mug of cherry hot chocolate!\r\n\r\nToday we are celebrating with a Black Forest chocolate made with rich chocolate, tart cherries, and delightfully airy whipped cream. And it can be made a little boozy if you have any kirsch or cherry-flavored brandy available.',
                'prod_date' => '2022-04-16',
                'prod_price' => 100.00,
                'prod_img' => 'product-625b7521544c03.95918544.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Blueberry Mint',
                'prod_description' => 'Made with an easy blueberry simple syrup, this lemonade is so refreshing, sweet and tangy. It’s the perfect way to cool down on a hot day!\r\n\r\nWith a simple blueberry syrup, this drink could not get any easier. It’s wonderfully fruity and sweet from the plump juicy blueberries with just enough of a tart kick. And it’s really the perfect way to cool down on a hot day. Plus, if you’re anything like me, well, you’ll sneak in some vodka for an adult-style lemonade!',
                'prod_date' => '2022-04-17',
                'prod_price' => 95.00,
                'prod_img' => 'product-625b76029ec146.11389834.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Lemon Peppermint',
                'prod_description' => 'Lemon and mint tea is a naturally caffeine free tea, has a strong aroma and flavor of mint because of its menthol content. This is an excellent herb tea that detoxifies, rejuvenates and soothes your body. \r\n\r\nMint leaves also known as pudina or mint derived from the Greek word Mintha is a genus of flowering plants from the Lamiaceae family.  Mint leaves are a leaf most well-known for the fragrance and cool refreshing taste. Mint can be either used as fresh leaves or dried and is best source of mint in cooking.',
                'prod_date' => '2022-04-14',
                'prod_price' => 60.00,
                'prod_img' => 'product-625b76c9c0b9a5.49694323.jpeg',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Green Apple',
                'prod_description' => 'Offer up a fun and delicious beverage your customers can trust with this Green Apple Soda. Crafted using pure cane sugar and natural flavors, this Green Apple Soda features a crisp, tart apple flavor for an irresistible treat your guests will appreciate. For best results, serve this soda chilled or over ice to accentuate its high quality taste. Whether served alone or as part of a specialty cocktail, this green apple soda is sure to please!',
                'prod_date' => '2022-04-17',
                'prod_price' => 70.00,
                'prod_img' => 'product-625b78a4ef2ba5.16242827.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Chocolate Malt Milo Godzilla',
                'prod_description' => 'Chocolate malt drinks are highly popular in Southeast Asia and are sometimes enjoyed together with a scoop of vanilla ice cream or whipped cream. As such, they are given fanciful names like “Milo Dinosaur” and “Milo Godzilla”.\r\n\r\nThe most popular chocolate malt brand that is Milo which is also widely available in Australia. One of the drinks, “Milo Dinosaur” is topped with heaps of chocolate malt powder while the other, “Milo Godzilla” is topped with whipped cream and/or vanilla ice cream. These heaps of chocolate malt powder are added to give extra crunch to the drinks.',
                'prod_date' => '2022-04-17',
                'prod_price' => 110.00,
                'prod_img' => 'product-625b7ad183f737.99631564.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Hokkaido Milk Tea',
                'prod_description' => 'Hokkaido milk tea is a unique tea-based beverage that originates from the Hokkaido region of Japan. Although green teas like Sencha and Gyokuro are the most common types of tea consumed in Japan, Hokkaido milk tea is actually made using black tea.',
                'prod_date' => '2022-05-02',
                'prod_price' => 90.00,
                'prod_img' => 'product-626f489b14a288.67485309.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Okinawa Milk Tea',
                'prod_description' => 'Okinawa milk tea also originated in Japan. It consists of a hearty black tea base blended with milk and Okinawa brown sugar. This special type of brown sugar, also known as kokuto, is made by reducing pure sugarcane juice, and has a complex, nuanced flavor and a high vitamin and mineral content.',
                'prod_date' => '2022-05-02',
                'prod_price' => 90.00,
                'prod_img' => 'product-626f4b29d573e1.29454575.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Irish Coffee',
                'prod_description' => 'The Irish Coffee may not be the first coffee drink with alcohol, but this cocktail has become one of the most famous. Combining coffee with Irish whiskey, brown sugar and lightly whipped cream, the Irish Coffee is a hot, creamy classic that can wake you up on cold mornings or keep you going after a long night.',
                'prod_date' => '2022-05-02',
                'prod_price' => 100.00,
                'prod_img' => 'product-626fd6c8429524.30894853.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Boba (Bubble Tea)',
                'prod_description' => 'Boba, often also known as bubble tea or pearl milk tea, is a unique milky tea flavored with tapioca pearls. While boba can be made without milk, milk or condensed milk is often added to the drink. This tea is typically served iced. Boba comes in many different flavors, from classic black tea versions to fruity, floral, or sweet concoctions. Boba originated in Taiwan, but is now popular all over the world.',
                'prod_date' => '2022-05-02',
                'prod_price' => 60.00,
                'prod_img' => 'product-626f4bc0863c60.13350175.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Masala Chai',
                'prod_description' => 'Masala Chai also has its origins in British colonization. Drinking tea became popular in India in the late 19th and early 20th centuries, when British colonists began growing tea in India rather than purchasing it from China. Masala Chai soon developed into a popular local drink in its own right, with traditional Indian spices added to black tea for a unique and satisfying drink. Masala Chai can be made by steeping tea and spices directly in steamed milk, or by adding milk to a cup of traditionally prepared tea. You can also make a chai latte by frothing the milk!',
                'prod_date' => '2022-05-02',
                'prod_price' => 50.00,
                'prod_img' => 'product-626f4c51b4f7f9.19357400.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Hong Kong Milk Tea',
                'prod_description' => 'This tea originated in Hong Kong, and may have its origins under the British colonial rule, where the practice of drinking afternoon tea with milk and sugar where introduced.',
                'prod_date' => '2023-05-10',
                'prod_price' => 55.00,
                'prod_img' => 'product-626f4d80283f72.96395552.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Milk Oolong',
                'prod_description' => 'Milk Oolong is a Taiwanese tea named for the creamy and buttery taste it passes in a cup of tea. It doesn’t actually contain any milk in it, but it really does taste like milk! Real Milk Oolong tea provides a taste of sweet butter and milk through gently roasted and rolled tea leaves, and has this sweet flowery scent.',
                'prod_date' => '2022-05-02',
                'prod_price' => 80.00,
                'prod_img' => 'product-626f4e1b38de40.29960723.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Thai Tea',
                'prod_description' => 'Thai tea is a combination of tea, milk, and sugar. This tea is often served as an iced tea, and usually has a base of Ceylon or Assam. Thai tea can be flavored using ingredients such as mint, lime, star anise, orange blossoms, tamarind, and other spices. It is sweetened with sugar or condensed milk. It is sold as a powdered mix, but you can also easily make this from scratch at home.',
                'prod_date' => '2022-05-28',
                'prod_price' => 70.00,
                'prod_img' => 'product-626f4f3dd47c87.30904535.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Caramel Frappuccino',
                'prod_description' => 'A blend of toffee nut syrup, Frappuccino Roast Coffee, milk and ice and topped with a layer of dark caramel sauce, finished with whipped cream and a drizzle of mocha sauce',
                'prod_date' => '2022-05-21',
                'prod_price' => 90.00,
                'prod_img' => 'product-626f50ed4da200.88650254.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Cinnamon Roll Frappuccino',
                'prod_description' => 'A blend of cinnamon dolce syrup, white chocolate mocha sauce, vanilla bean, Frappuccino Roast Coffee, milk and ice, finished with whipped cream and a sprinkle of cinnamon dolce topping',
                'prod_date' => '2022-05-21',
                'prod_price' => 90.00,
                'prod_img' => 'product-626f515eb23544.85377978.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Cotton Candy Frappuccino',
                'prod_description' => 'A blend of vanilla bean, raspberry syrup, milk and ice, finished with whipped cream',
                'prod_date' => '2022-05-02',
                'prod_price' => 90.00,
                'prod_img' => 'product-626f51db33c3f3.61752877.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Bloody Red Velvet Hot Chocolate',
                'prod_description' => 'Thick and creamy bloody red velvet hot chocolate made with chocolate chips and red velvet cake mix. Top with whipped cream and blood splatter!',
                'prod_date' => '2022-05-02',
                'prod_price' => 99.00,
                'prod_img' => 'product-626f53a6c930c1.84790323.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Vanilla Bean Frappuccino',
                'prod_description' => 'It all comes down to the fact that there\'s just nothing special going on here. There\'s no drizzle of chocolate or caramel to compete with the overwhelming flavor of the vanilla. And after a few sips, you\'re probably going to be over it.',
                'prod_date' => '2022-06-11',
                'prod_price' => 85.00,
                'prod_img' => 'product-626f5478763003.57192123.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Green Tea',
                'prod_description' => 'After the fresh, green tea leaves and buds have been picked from the tea plants, they’re withered to reduce moisture and “fixed” to keep their verdant and green qualities. By quickly heating the leaves (by firing them in pans or an oven, or steaming them with water) you deactivate the enzymes that oxidize the leaves and turn them brown.',
                'prod_date' => '2022-05-02',
                'prod_price' => 80.00,
                'prod_img' => 'product-626f58965f9198.17312719.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Rooibos Tea',
                'prod_description' => 'Rooibos (red bush) is an herbal tea from South Africa. It’s naturally caffeine-free and contains as many antioxidants if not more than traditional tea. Without flavoring or additives, rooibos tea is rich, full-bodied, sweet and a little nutty. It’s a great caffeine-free alternative to tea. Health benefits of drinking rooibos tea include reducing blood pressure (thus reducing the risks of heart disease), improving skin and hair strength and preventing diabetes.',
                'prod_date' => '2022-05-02',
                'prod_price' => 88.00,
                'prod_img' => 'product-626f597e636e56.12570149.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Orange Peel Black Tea',
                'prod_description' => 'Tangy and sweet with a little bite, Orange Peel blends organic black tea with organic orange peels for a delicious drink that\'s loaded with citrusy flavor. Aromatic and naturally sweet, this tea is sure to be a crowd-pleaser.',
                'prod_date' => '2022-05-02',
                'prod_price' => 70.00,
                'prod_img' => 'product-626f5a3454f514.98414094.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Mango Green Tea',
                'prod_description' => 'This refreshing mango green tea gets ready in under 10 minutes using simple ingredients. Make a big pitcher using fresh or frozen mangoes.',
                'prod_date' => '2022-05-28',
                'prod_price' => 79.00,
                'prod_img' => 'product-626f5b0810ea03.09467886.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Very Berry Iced Tea',
                'prod_description' => 'This Very Berry Iced Tea with Honey Mint Syrup is so refreshing and filled with the tastes of summer.',
                'prod_date' => '2022-05-28',
                'prod_price' => 90.00,
                'prod_img' => 'product-626f5cc93f39f0.74019900.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Strawberry',
                'prod_description' => 'Strawberry tea is a red, sweet, fruity, and freshly brewed tea that is flavored with fresh summer strawberries.',
                'prod_date' => '2022-05-02',
                'prod_price' => 90.00,
                'prod_img' => 'product-626fcc5dd563d0.77457183.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Honey Lemon Tea',
                'prod_description' => 'Honey lemon tea is as a body cleanser. · It serves as a digestive aid by providing an overall calming effect on the stomach.',
                'prod_date' => '2022-05-02',
                'prod_price' => 75.00,
                'prod_img' => 'product-626fcd85941151.56776060.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Cranberry Tea',
                'prod_description' => 'Drinking cranberry tea is safe and provides numerous health benefits. Filled with vitamins and anti-oxidants, cranberry tea sure is a delicious way to stay healthy!',
                'prod_date' => '2022-05-26',
                'prod_price' => 99.00,
                'prod_img' => 'product-626fcfee55a546.05367280.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Fruit Tea',
                'prod_name' => 'Blueberry Tea',
                'prod_description' => 'Blueberry tea is made by steeping leaves of the blueberry bush in hot water. A fragrant and delicious beverage, it provides a number of unique health benefits that make it both refreshing to drink and beneficial to your body.',
                'prod_date' => '2022-05-02',
                'prod_price' => 80.00,
                'prod_img' => 'product-626fd0aecd0311.66059397.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Caffe Mocha',
                'prod_description' => 'A caffè latte with chocolate and whipped cream, made by pouring about 2 cl of chocolate sauce into the glass, followed by an espresso shot and steamed milk.',
                'prod_date' => '2022-05-02',
                'prod_price' => 120.00,
                'prod_img' => 'product-626fd1d6b07ec5.73293609.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Latte Macchiato',
                'prod_description' => 'Like a traditional caffè latte, but with a thicker layer of foam. Often made by pouring an espresso last into the milk (drink size about 300 ml). Served in a latte glass.',
                'prod_date' => '2022-05-30',
                'prod_price' => 65.00,
                'prod_img' => 'product-626fd29e818551.84485654.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Espresso Con Panna',
                'prod_description' => 'A shot of espresso topped with whipped cream. Served in an espresso cup.',
                'prod_date' => '2022-05-02',
                'prod_price' => 50.00,
                'prod_img' => 'product-626fd473bde286.15018451.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Americano',
                'prod_description' => 'Espresso with added hot water (100–150 ml). Often served in a cappuccino cup. (The espresso is added into the hot water rather than all the water being flowed through the coffee that would lead to over extraction.)',
                'prod_date' => '2022-05-02',
                'prod_price' => 65.00,
                'prod_img' => 'product-626fd707085642.98688291.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Double Espresso (Doppio)',
                'prod_description' => 'Double portion of espresso in a cappuccino/espresso cup.',
                'prod_date' => '2022-05-02',
                'prod_price' => 60.00,
                'prod_img' => 'product-626fd5caac9335.74572430.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Espresso',
                'prod_description' => 'A short, strong drink (about 30 ml) served in an espresso cup.',
                'prod_date' => '2022-05-02',
                'prod_price' => 60.00,
                'prod_img' => 'product-626fd64702cff6.79665671.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Irish Coffee',
                'prod_description' => 'Classic coffee cocktail where Irish whiskey is mixed with filter coffee and topped with a thin layer of gently whipped cream.',
                'prod_date' => '2022-05-02',
                'prod_price' => 100.00,
                'prod_img' => 'product-626fd6c8429524.30894853.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Hot Drinks',
                'prod_name' => 'Lungo',
                'prod_description' => 'Lungo, or long in Italian, is a type of Espresso-based coffee drink. As the name suggests, this type of coffee is longer than the traditional espresso; requiring a larger coffee to water ratio.',
                'prod_date' => '2022-05-02',
                'prod_price' => 79.00,
                'prod_img' => 'product-626fd79a0328f8.62371142.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Hibiscus Mocktini',
                'prod_description' => 'Mix equal parts hibiscus tea and ginger ale for a sparkling summer drink.',
                'prod_date' => '2022-05-02',
                'prod_price' => 55.00,
                'prod_img' => 'product-626fd88306cdf2.44063163.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Ginger Beer',
                'prod_description' => 'Despite its name, ginger beer is a kid-friendly summer drink. This homemade version can be served on its own, or can help you kick your standard Moscow Mule or Dark and Stormy up a notch.',
                'prod_date' => '2022-05-02',
                'prod_price' => 50.00,
                'prod_img' => 'product-626fd90059a489.17559009.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Espresso Slushy',
                'prod_description' => 'Instant espresso gives a low-cal cool drink some kick.',
                'prod_date' => '2022-05-20',
                'prod_price' => 55.00,
                'prod_img' => 'product-626fd9904ef596.98079938.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Raspberry Fizz',
                'prod_description' => 'Top a ginger ale–cranberry juice combo with scoops of raspberry sorbet.',
                'prod_date' => '2022-05-02',
                'prod_price' => 88.30,
                'prod_img' => 'product-626fd9f3867867.40578171.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Iced Green Tea with Ginger and Mint',
                'prod_description' => 'Spice up a refreshing green iced tea with the flavors of fresh ginger and mint.',
                'prod_date' => '2022-05-02',
                'prod_price' => 75.00,
                'prod_img' => 'product-626fdaece15e12.84185148.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Watermelon Mint Cooler',
                'prod_description' => 'This summer drink is as juicy and refreshing as a slice of watermelon on a sweltering afternoon.',
                'prod_date' => '2022-05-02',
                'prod_price' => 60.00,
                'prod_img' => 'product-626fdb57470f55.27962380.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Cucumber and Lime Spritzer',
                'prod_description' => 'Slightly tart and brisk, this is a mocktail for grown-ups.',
                'prod_date' => '2022-05-31',
                'prod_price' => 55.00,
                'prod_img' => 'product-626fdbd65f7b26.24584763.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Sparkling Pineapple Ginger Ale',
                'prod_description' => 'Pineapple sweetens the tang of ginger ale for a cool drink with tropical vibes.',
                'prod_date' => '2022-05-02',
                'prod_price' => 89.00,
                'prod_img' => 'product-626fdcdd116155.06123354.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Cold Drinks',
                'prod_name' => 'Iced Tea with Plums and Thyme',
                'prod_description' => 'Serve this fruit-and-herb blend as a nonalcoholic sipper or spike it with bourbon.',
                'prod_date' => '2022-05-31',
                'prod_price' => 78.00,
                'prod_img' => 'product-626fdceeebac32.21492958.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Black Forest Frappe',
                'prod_description' => 'With prospects of a warm and sunny weekend why not relax and enjoy this delicious Black Forest Frappe.',
                'prod_date' => '2022-05-02',
                'prod_price' => 150.00,
                'prod_img' => 'product-626fdd94b321b1.70766533.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Cookies and Cream Frappe',
                'prod_description' => 'A grownup coffee drink meets a childhood favorite.',
                'prod_date' => '2022-05-02',
                'prod_price' => 120.00,
                'prod_img' => 'product-626fde5e2f1e45.35216972.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Frappe',
                'prod_name' => 'Mocha Cookie Crumble',
                'prod_description' => 'Frappuccino Roast coffee, mocha sauce and Frappuccino chips blended with milk and ice, layered on top of whipped cream and chocolate cookie crumble and topped with vanilla whipped cream, mocha drizzle and even more chocolate cookie crumble.',
                'prod_date' => '2022-05-02',
                'prod_price' => 180.00,
                'prod_img' => 'product-626fdf0e9b2df8.58041966.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Milk Tea',
                'prod_name' => 'Yakult Milk Tea',
                'prod_description' => 'Offers a variety of flavours under their Yakult drink line, so if you’re up for something a little more fruity, feel free to try their Lychee, Strawberry, Passionfruit, Peach or Jasmine Tea Yakult drink!',
                'prod_date' => '2022-05-19',
                'prod_price' => 95.00,
                'prod_img' => 'product-626fe011eea749.37763737.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Strawberry Watermelon Lemonade',
                'prod_description' => 'A drink full of sweet-tart flavor.',
                'prod_date' => '2022-05-02',
                'prod_price' => 88.00,
                'prod_img' => 'product-626fe1048c7cd6.03431136.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Peach-Basil Lemonade Slush',
                'prod_description' => 'This chilly slush with peaches, lemon juice and garden-fresh basil is hands-down the best lemonade ever. It tastes just like summer.',
                'prod_date' => '2022-05-02',
                'prod_price' => 95.00,
                'prod_img' => 'product-626fe14ec15895.25607047.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Blackberry Beer Cocktail',
                'prod_description' => 'This refreshing hard lemonade has a mild alcohol flavor; the beer adds just enough fizz to dance on your tongue as you sip. Sorry, adults only!',
                'prod_date' => '2022-05-02',
                'prod_price' => 165.00,
                'prod_img' => 'product-626fe1c8b75322.73446216.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Summertime Tea',
                'prod_description' => 'You can’t have a summer gathering around here without this sweet tea to cool you down. It’s wonderful for sipping while basking by the pool.',
                'prod_date' => '2022-05-02',
                'prod_price' => 89.00,
                'prod_img' => 'product-626fe1fbe429d8.38661272.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Kentucky Lemonade',
                'prod_description' => 'Mint and bourbon give this drink a bit of a Kentucky kick, and ginger ale makes it a fizzy party punch.',
                'prod_date' => '2022-05-27',
                'prod_price' => 75.00,
                'prod_img' => 'product-626fe2671a9a73.91834096.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Rosemary Lemonade',
                'prod_description' => 'The herb makes the drink taste fresh and light, and it\'s a pretty garnish.',
                'prod_date' => '2022-05-02',
                'prod_price' => 55.00,
                'prod_img' => 'product-626fe2a8ab92e7.32713412.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Red and Blue Berry Lemonade Slush',
                'prod_description' => 'This delightfully sweet-tart beverage showcases fresh raspberries and blueberries.',
                'prod_date' => '2022-05-02',
                'prod_price' => 79.00,
                'prod_img' => 'product-626fe2e5b9c518.28673239.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Blackberry Lemonade',
                'prod_description' => 'Here\'s a special drink that\'s perfect when blackberries are in season. It has a tangy, refreshing flavor.',
                'prod_date' => '2022-05-02',
                'prod_price' => 89.00,
                'prod_img' => 'product-626fe3364079c2.95746748.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Lemonade',
                'prod_name' => 'Sparkling Kiwi Lemonade',
                'prod_description' => 'Keep some kiwi ice cubes in the freezer so they’re ready whenever you crave a tall glass of this dressed-up summertime favorite.',
                'prod_date' => '2022-05-02',
                'prod_price' => 69.00,
                'prod_img' => 'product-626fe396af2710.55361264.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Chocolate soy thickshake',
                'prod_description' => 'Indulge in this dairy-free chocolate thickshake.',
                'prod_date' => '2022-05-03',
                'prod_price' => 55.00,
                'prod_img' => 'product-6270b0a277e105.36890627.jpeg',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Cherry yoghurt soy shake',
                'prod_description' => 'Serve milkshakes topped with a scoop of sorbet.',
                'prod_date' => '2022-05-03',
                'prod_price' => 60.00,
                'prod_img' => 'product-6270b3cb6dbaa3.91973706.jpeg',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Cherry yoghurt soy shake',
                'prod_description' => 'Serve milkshakes topped with a scoop of sorbet.',
                'prod_date' => '2023-05-04',
                'prod_price' => 60.00,
                'prod_img' => 'product-6270b38e3346a4.98098766.jpg',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Mango soya milk shake',
                'prod_description' => 'Plain protein-rich soya milk may be boring, but your kids can\'t resist it when blended with vitamin A-rich mango pulp',
                'prod_date' => '2022-05-03',
                'prod_price' => 75.00,
                'prod_img' => 'product-6270b4ba3f6318.42741058.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Strawberry soy milk shake',
                'prod_description' => 'Enjoy the goodness of tofu, soya milk with strawberries',
                'prod_date' => '2022-05-03',
                'prod_price' => 89.00,
                'prod_img' => 'product-6270b5a8e46b27.64519017.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Apricot apple smoothie',
                'prod_description' => 'Best energizing drink to keep you going all day. A combination of ingredients like banana, nuts, apples, and soya milk. Perfect energy drink after exercising',
                'prod_date' => '2022-05-03',
                'prod_price' => 89.00,
                'prod_img' => 'product-6270b734656312.18329747.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Flax seed smoothie',
                'prod_description' => 'The use of fibre-rich flax seeds and calcium and protein-rich soya milk lends a healthy angle to the flax seed smoothie. At the same time, the lemon juice plays an indispensable role in enhancing the flavours of the scrumptious fruits used in this smoothie.',
                'prod_date' => '2022-05-03',
                'prod_price' => 75.00,
                'prod_img' => 'product-6270b8152f4a97.28486276.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'Espresso Soy Milk Shake',
                'prod_description' => 'Willett is a fan of soy milk and ice cream. This satisfying shake is a speedy dessert. It\'s also a way to enjoy the health benefits of caffeine, which may help lower your risk of diabetes and Parkinson\'s disease.',
                'prod_date' => '2022-05-03',
                'prod_price' => 70.00,
                'prod_img' => 'product-6270b90867b0c1.08407076.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soya Drink',
                'prod_name' => 'SOY MILK HOT CHOCOLATE',
                'prod_description' => 'The best way to spend a snowy day is cuddling on the couch with the family, a furry friend, or just a significant other, with a classic holiday movie playing and a warm cup of hot chocolate in your hands.',
                'prod_date' => '2022-05-03',
                'prod_price' => 89.00,
                'prod_img' => 'product-6270b9d01c7e63.89781170.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Blue Lagoon Mocktail',
                'prod_description' => 'This refreshing non-alcoholic drink is easy to make for kids and adults to enjoy. Savor this blue lagoon mocktail on hot summer days. You can even make it into a fun slushy!',
                'prod_date' => '2022-05-03',
                'prod_price' => 78.00,
                'prod_img' => 'product-6270ba54084241.61021214.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Virgin Blackberry Rosewater Smash',
                'prod_description' => 'The best refreshing drink, featuring blackberries, lime, and rosewater, is called virgin blackberry rosewater smash. A hit at every party!',
                'prod_date' => '2022-05-28',
                'prod_price' => 90.00,
                'prod_img' => 'product-6270bb174246f0.76339678.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Cranberry Celebration',
                'prod_description' => 'A nice choice for holiday entertaining, this fresh-flavored cranberry cocktail is made with vodka, a cranberry-orange reduction, lemon juice and club soda.',
                'prod_date' => '2022-05-03',
                'prod_price' => 99.00,
                'prod_img' => 'product-6270bbb2c4a511.31869773.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Raspberry Burnet Soda Pop',
                'prod_description' => 'This simple and refreshing beverage has the tart flavor of raspberries and lime and the subtle flavor of cucumber that comes from the herb burnet.',
                'prod_date' => '2022-05-03',
                'prod_price' => 120.00,
                'prod_img' => 'product-6270bce0385f52.51657172.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Cucumber Agua Fresca',
                'prod_description' => 'Agua fresca de pepino or cucumber agua fresca is a delicious and refreshing beverage made from fresh cucumbers, citrus juice, water, and a touch of sweetener.',
                'prod_date' => '2022-05-03',
                'prod_price' => 79.00,
                'prod_img' => 'product-6270bd4628d7c7.58163084.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Coffee soda',
                'prod_description' => 'This homemade, do-it-yourself coffee soda is so simple to make and a really fun way to enjoy your coffee.',
                'prod_date' => '2023-05-17',
                'prod_price' => 50.00,
                'prod_img' => 'product-6270bd9ac0cd19.91474006.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Mango Mint Limeade Slush',
                'prod_description' => 'This refreshing fruit slush is the perfect beverage to cool you down this summer! This blended frozen drink combines mangos, mint, lime, and coconut water.',
                'prod_date' => '2022-05-03',
                'prod_price' => 60.00,
                'prod_img' => 'product-6270be4b6ec572.17582986.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Cream Soda',
                'prod_description' => 'Cream Soda is a super simple, nostalgic soda recipe that\'s easy to make at home and is so refreshing on warm summer days.',
                'prod_date' => '2022-05-03',
                'prod_price' => 45.00,
                'prod_img' => 'product-6270bed9085342.27173677.png',
                'status' => 'Available'
            ],
            [
                'category' => 'Soda Pops',
                'prod_name' => 'Soda Syrups',
                'prod_description' => 'Resist popping tabs this season and get familiar with the ultimate cola cure: soda syrups made from fresh fruits and herbs.',
                'prod_date' => '2022-05-28',
                'prod_price' => 55.00,
                'prod_img' => 'product-6270bf725a84e5.31574158.png',
                'status' => 'Available'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
