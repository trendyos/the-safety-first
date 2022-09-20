<table width="100%" class="table table-striped">
                                                <tr>
                                                    <th>
                                                        Feedback Form Please share your experience during the medical examination process as below
                                                    </th>
                                                    <th>
                                                        Excellent
                                                    </th>
                                                    <th>
                                                       Very Good
                                                    </th>
                                                    <th>
                                                        Good
                                                    </th>
                                                    <th>
                                                        Fair
                                                    </th><th>
                                                       Poor
                                                    </th>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td>
                                                        Overall Experience With the medical examination process
                                                    </th>
                                                    
                                                        @foreach($feedbacks as $feedback)
                                                        <td>
                                <input type="checkbox" name="overall_expeirence[]" 
                                {{in_array($feedback, explode(',',$val->overall_expeirence))?"checked":null}} disabled
                                value="{{ $feedback}}" id="inlineCheckbox{{$feedback}}">
                                 </td>
                                     @endforeach
                                                   
                                                   
                                                    
                                                </tr>
                                                
                                                 <tr>
                                                    <td>
                                                       Medical Facility :(Ease of Locating, Set up, instruments, cleanliness, process

followed)
                                                    </th>
                                                    
                                                        @foreach($feedbacks as $feedback)
                                                        <td>
                                <input type="checkbox" name="medical_facility[]" 
                                 {{in_array($feedback, explode(',',$val->medical_facility))?"checked":null}} disabled
                                value="{{ $feedback}}" id="inlineCheckbox{{$feedback}}">
                                 </td>
                                     @endforeach
                                                   
                                                   
                                                    
                                                </tr>
                                                
                                                 <tr>
                                                    <td>
                                                      Reception at Clinic / Hospital
                                                    </th>
                                                    
                                                        @foreach($feedbacks as $feedback)
                                                        <td>
                                <input type="checkbox" name="reception[]" 
                                 {{in_array($feedback, explode(',',$val->reception))?"checked":null}} disabled
                                value="{{ $feedback}}" id="inlineCheckbox{{$feedback}}">
                                 </td>
                                     @endforeach
                                                   
                                                   
                                                    
                                                </tr>
                                                
                                                 <tr>
                                                    <td>
                                                        Behavior and cooperation of staff at reception
                                                    </th>
                                                    
                                                        @foreach($feedbacks as $feedback)
                                                        <td>
                                <input type="checkbox" name="behavior_of_staff[]" 
                                 {{in_array($feedback, explode(',',$val->behavior_of_staff))?"checked":null}} disabled
                                value="{{ $feedback}}" id="inlineCheckbox{{$feedback}}">
                                 </td>
                                     @endforeach
                                                   
                                                   
                                                    
                                                </tr>
                                                
                                                 <tr>
                                                    <td>
                                                        Courtesy and politeness of the doctor/medical staff for Technical Know

how, Behavior, Appearance etc

                                                    </th>
                                                    
                                                        @foreach($feedbacks as $feedback)
                                                        <td>
                                <input type="checkbox" name="courtesy_and_politeness[]" 
                                 {{in_array($feedback, explode(',',$val->courtesy_and_politeness))?"checked":null}} disabled
                                value="{{ $feedback}}" id="inlineCheckbox{{$feedback}}">
                                 </td>
                                     @endforeach
                                                   
                                                   
                                                    
                                                </tr>
                                                
                                                 <tr>
                                                    <td>
                                                        Experience with the waiting time before the test began

                                                    </th>
                                                    
                                                        @foreach($feedbacks as $feedback)
                                                        <td>
                                <input type="checkbox" name="waiting_time[]" 
                                {{in_array($feedback, explode(',',$val->waiting_time))?"checked":null}} disabled
                                value="{{ $feedback}}" id="inlineCheckbox{{$feedback}}">
                                 </td>
                                     @endforeach
                                                   
                                                   
                                                    
                                                </tr>
                                            </table>