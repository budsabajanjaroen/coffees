

<!-- Testimonial Start -->
<?php 
// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM ingredients";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$ingredientss = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array

// ดึงข้อมูล id_ingredients ที่เชื่อมโยงกับ id_page = 1
$pageingredientsSql = "SELECT id_ingredients FROM page_ingredients WHERE id_page = 1";
$pageingredientsStmt = $pdo->prepare($pageingredientsSql);
$pageingredientsStmt->execute();
$selectedingredientss = $pageingredientsStmt->fetchAll(PDO::FETCH_COLUMN);

?>
<div class="container-xxl py-6" id="Team">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">HAPPY COFFEE & HAPPY COFFEE GOLD & HAPPY COFFEE MAX</p>
                <h1 class="display-6 mb-4">สารสกัดจากธรรมชาติมากกว่า <?= count($selectedingredientss);?> ชนิด</h1>
            </div>
            <div class="row g-4">


            <?php if (!empty($selectedingredientss)): ?>
                <?php foreach ($ingredientss as $index => $ingredients): ?>
                    <?php if (in_array($ingredients['id_ingredients'], $selectedingredientss)): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <img class="img-fluid" src="/coffees/img/ingredients/<?= $ingredients['img_ingredients']; ?>" alt="">
                            <div>
                                <div>
                                    <h5><?= $ingredients['name_ingredients']; ?></h5>
                                    <span><?= $ingredients['detail_ingredients']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>


                <!-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/1.png" alt="">
                        <div>
                            <div>
                                <h5>อินทผลัม</h5>
                                <span>เป็นผลไม้ที่อุดมไปด้วยคุณค่าทางโภชนาการสูง มีไฟเบอร์ มีส่วนช่วยควบคุมระดับน้ำตาล
                                    คอเรสเตอรอลในเลือดและช่วยบำรุงสายตา</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/2.png" alt="">
                        <div>
                            <div>
                                <h5>อะโวคาโดและสารสกัดถั่วเหลือง</h5>
                                <span>งานวิจัยรองรับว่ามีส่วนช่วยดูแลกระดูกและ ข้อต่อ
                                    มีไฟโตสเตอรอลช่วยลดการดูดซึมคอเลสเตอรอล</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/3.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดจากสมุนไพรสมอพิเภก</h5>
                                <span>ต้านสารอนุมูลอิสระควบคุมระดับกรดยูริคในเลือด ที่เป็นสาเหตุของโรคเกาต์</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/4.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดขมิ้นชัน</h5>
                                <span>Curcuminoids มีฤทธิ์ในการต้านอนุมูลอิสระ ต้านการอักเสบ
                                    และมีส่วนช่วยบรรเทาอาการปวดข้อเข่า</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/5.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดอาซาอิ</h5>
                                <span>Superfood ผลไม้ต้านอนุมูลอิสระชั้นสูง ปรับระดับคอเลสเตอรอล</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/6.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดแครอท</h5>
                                <span> ชะลอการเสื่อมของเซลล์ บำรุงสุขภาพสายตา บำรุงผิวพรรณ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/7.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดมากิเบอร์รี่ </h5>
                                <span>ต้านอนุมูลอิสระสูงที่สุดในโลก เพิ่มการเผาผลาญ ดูแลผิวพรรณ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/8.png" alt="">
                        <div>
                            <div>
                                <h5>มัลติวิตามิน </h5>
                                <span>ไม่ว่าจะเป็น B3,B5,B6,B12</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/9.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดจากโกจิเบอร์รี่</h5>
                                <span>แอนติซิแดนท์อุดมด้วย แคร์โรทีนอยด์ ช่วนเรื่องบำรุงสายตา</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/10.png" alt="">
                        <div>
                            <div>
                                <h5>กาแฟอะราบิกา</h5>
                                <span>ลดความเครียด ความอ่อนล้า เพิ่มไขมันดี (HDL)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/11.png" alt="">
                        <div>
                            <div>
                                <h5>ผงถั่วขาวสกัด </h5>
                                <span>ถั่วขาวนั้นยังประกอบไปด้วยสาร "ฟาซิโอลามีน"
                                    ซึ่งมีคุณสมบัติในการย่อยแป้งให้กลายเป็นน้ำตาลก่อนถูกดูดซึม</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/12.png" alt="">
                        <div>
                            <div>
                                <h5>คอลลาเจน</h5>
                                <span>เสริมสร้างความกระจ่างใส & ช่วยฟื้นฟูดูแลสุขภาพผิวให้กระชับ เรียบเนียน
                                    ลดการเสื่อมสภาพของข้อต่อ เพิ่มความแข็งแรงให้กับกระดูกและข้อ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/13.png" alt="">
                        <div>
                            <div>
                                <h5>แอล-อาร์จินีน (L-Arginine) </h5>
                                <span>ส่งเสริมการไหลเวียนโลหิต
                                    ลดความดันโลหิต ช่วยลดความเสี่ยงของโรคหัวใจ
                                    เพิ่มสมรรถภาพทางเพศช่วยลดไขมันและเพิ่มมวลกล้ามเนื้อ
                                    เสริมสร้างภูมิคุ้มกันและช่วยฟื้นตัวหลังเจ็บป่วย เร่งกระบวนการซ่อมแซมเนื้อเยื่อ
                                    ลดความเมื่อยล้าหลังการออกกำลังกาย ช่วยควบคุมน้ำตาลในเลือด</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/14.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดโสมเกาหลี </h5>
                                <span>ช่วยกระตุ้นระบบประสาทและการทำงานของสมอง กระตุ้นการทำงานของเซลล์เม็ดเลือดขาว
                                    ลดโอกาสติดเชื้อไวรัสและแบคทีเรีย ช่วยลดระดับคอเลสเตอรอลและไตรกลีเซอไรด์ในเลือด
                                    มีส่วนช่วยเพิ่มสมรรถภาพทางเพศในผู้ชาย
                                    ส่งเสริมสุขภาพของระบบสืบพันธุ์ในผู้หญิง ช่วยเพิ่มความจำ สมาธิ และการตัดสินใจ
                                    ลดความเสี่ยงของโรคสมองเสื่อม เช่น อัลไซเมอร์ ปรับสมดุลอารมณ์และช่วยให้ผ่อนคลาย
                                    มีสารต้านอนุมูลอิสระที่ช่วยชะลอความเสื่อมของเซลล์
                                    ส่งเสริมการสร้างคอลลาเจน ทำให้ผิวพรรณกระจ่างใส ช่วยปรับสมดุลอินซูลินในร่างกาย
                                    ลดความเสี่ยงของโรคเบาหวาน</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/15.png" alt="">
                        <div>
                            <div>
                                <h5>ผงกระเทียม</h5>
                                <span>ลดระดับคอเลสเตอรอล ลดความดันโลหิต
                                  ลดความเสี่ยงโรคหัวใจและหลอดเลือด
                                    มีฤทธิ์ต้านเชื้อแบคทีเรีย ไวรัส และเชื้อรา
                                    กระตุ้นระบบภูมิคุ้มกันให้แข็งแรง
                                    เหมาะสำหรับผู้ที่มีภาวะเบาหวานหรือความเสี่ยงต่อโรคนี้
                                    ชะลอการเสื่อมของเซลล์
                                    กระตุ้นการหลั่งน้ำย่อย
                                    ลดอาการท้องอืด ท้องเฟ้อ หรืออาหารไม่ย่อย
                                    มีส่วนช่วยในการกระตุ้นการเผาผลาญ
                                    ลดการสะสมไขมันในร่างกาย</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/16.png" alt="">
                        <div>
                            <div>
                                <h5>ซิงค์ อะมิโน แอซิด คีเลต</h5>
                                <span>ดูดซึมได้ดีกว่าสังกะสีรูปแบบอื่น
                                    ลดการระคายเคืองกระเพาะอาหาร
                                    เหมาะสำหรับผู้ที่ต้องการเสริมแร่ธาตุสังกะสีเพื่อประโยชน์ทางสุขภาพในระยะยาว</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/17.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดเห็ดหลินจือ</h5>
                                <span>เสริมสร้างระบบภูมิคุ้มกัน ต้านการอักเสบ ช่วยลดความเครียดและส่งเสริมสุขภาพจิต
                                    ส่งเสริมสุขภาพหัวใจและหลอดเลือด ช่วยต้านมะเร็ง ส่งเสริมการทำงานของตับ
                                    ปรับสมดุลน้ำตาลในเลือด ต้านอนุมูลอิสระและชะลอวัย
                                    เสริมการทำงานของระบบทางเดินหายใจ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/logo/18.png" alt="">
                        <div>
                            <div>
                                <h5>สารสกัดกระชายดำ</h5>
                                <span>เสริมสมรรถภาพทางเพศ
                                    ช่วยกระตุ้นการไหลเวียนของเลือด
                                    มีผลช่วยปรับสมดุลฮอร์โมนเพศ
                                    เสริมพลังงานและลดความเหนื่อยล้า
                                    ลดความเสี่ยงของโรคหัวใจและหลอดเลือด
                                    ต้านอนุมูลอิสระและชะลอวัย
                                    ลดริ้วรอยและชะลอความเสื่อมของเซลล์
                                     ลดอาการปวดข้อและการอักเสบ
                                    ช่วยปรับสมดุลระดับน้ำตาลในเลือด
                                    ลดความเสี่ยงของโรคเบาหวาน
                                    ช่วยกระตุ้นการหลั่งน้ำย่อยและลดอาการท้องอืด
                                    มีฤทธิ์ต้านการอักเสบในร่างกาย
                                   </span>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
    <!-- Team End -->
