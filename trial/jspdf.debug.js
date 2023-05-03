<table id="example" class="display nowrap">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Item</th>
                            <th>Quanity</th>
                            <th>Total Amount</th>
                        </tr> </thead>
                        <tbody>
                            <?php
                        $sql = "SELECT Sum(quantity), item_id FROM `purchase_child` GROUP BY item_id";
                        $result = $database->query($sql);
                        $s=0;
                        while($row = mysqli_fetch_array($result)){
                          
                        $s++;


                        ?>
                        <tr>
                            <td><?php echo $s; ?></td>
                            <td><?php
                            $variant= Variant::find_by_id($row[1]);
                           
                            $product = Product::find_by_id($variant->product_id);
                            echo " $product->name Color: $variant->color Size: $variant->size ";   ?></td>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php 
                            $sql="SELECT * FROM purchase_child WHERE item_id= '{$row[1]}' ";
                            $pms = Purchase_child::find_by_query($sql);
                            $total = 0;
                            foreach($pms as $pm){
                                $total = $total + ($pm->quantity * $pm->rate);
                                
                            }
                            echo $total;
                            
                            ?>
                        
                        
                        </td>
                        </tr>
                       <?php } ?>
                        
                    </tbody>
                    </table>
                      