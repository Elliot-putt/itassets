@extends('layouts.app')

@section('title', 'View Help Files')


@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Help</h1>
        <div>
            <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                    class="fas fa-chevron-left fa-sm text-white-50"></i> Back to Dashboard</a>
        </div>
    </div>

    <x-handlers.alerts/>

    <section>
        <div id="accordion">
            <p class="mb-4">Below are different Buttons, one for each Item in the management system. Each tile
                            has different information that can Help you understand how to use this system. If you
                            require Anymore
                            assistance please email <strong>apollo@clpt.co.uk</strong></p>
            {{--      heading one      --}}
            <div id="headingOne" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseOneExports" aria-expanded="false" aria-controls="collapseOne">
                    Exports
                </button>

            </div>
            <div id="collapseOneExports" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">How do I Export the data i need?</h2>

                    <p class="text-gray-700">Most Interfaces have in the top right hand corner have a Button which once
                                             clicked will return all results of your current page to a
                        <strong>'.csv'</strong> file.</p>
                    <div class="d-sm-flex align-items-center ">
                        <button class="btn btn-sm btn-warning shadow-sm m-2">Export</button>
                        <p class="text-gray-600 mt-3">This is an example export button</p>
                    </div>
                    <h4 class="text-info">Items Below Which can be exported:</h4>
                    <ul>
                        <li>Assets</li>
                        <li>Miscellaneous</li>
                        <li>Components</li>
                        <li>Users</li>
                        <li>Locations</li>
                        <li>Manufacturers</li>
                        <li>Suppliers</li>
                    </ul>
                    <p class="text-info">All Imports Have the option to export the errors Which you encounter</p>
                </div>
            </div>
            {{--      heading one end      --}}
            {{--     heading two       --}}
            <div id="headingTwoo" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwooPasswords" aria-expanded="false" aria-controls="collapseTwoo">
                    Passwords
                </button>

            </div>
            <div id="collapseTwooPasswords" class="collapse" aria-labelledby="headingTwoo" data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">I've Lost my Password What can i do?</h2>
                    <p class="text-gray-700">If You have Forgot your password you can click <a
                            href="{{route("forgot.my.password")}}" class="text-capitalize">here</a> to reset your
                                             password by your email! else please contact your Admin and they will reset
                                             this for you!</p>
                    <h2 class="text-info mt-2">I know my password How can i reset this?</h2>
                    <p class="text-gray-700">If you know your password you can navigate through the profile link in the
                                             top right or Click <a href="{{route("user.details")}}"
                                                                   class="text-capitalize">here</a>.</p>
                    <h4 class="text-info">Steps to reset:</h4>
                    <ol>
                        <li>Find Out your password from your original sign up email.</li>
                        <li>Navigate to the link above and click reset password</li>
                        <li>Input your current password to the top box</li>
                        <li>Think of a new password and match this in both Boxes <strong class="text-danger">(Capitals
                                                                                                             are
                                                                                                             included!)</strong>
                        </li>
                    </ol>
                </div>
            </div>
            {{--     heading two end       --}}
            {{--     heading three       --}}
            <div id="headingThree" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseThreeAssets" aria-expanded="false" aria-controls="collapseThree">
                    Assets
                </button>
            </div>
            <div id="collapseThreeAssets" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Devices?</h2>
                    <p class="text-gray-700">Assets can be located within the left hand side menu Labeled 'Assets' Can't
                                             find it? Click<a href="{{route("assets.index")}}" class="text-capitalize">
                            here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side!</p>
                    <h4 class="text-info">I need to find all the devices at my current School How can i do this?</h4>
                    <p class="text-gray-700">Our Asset Area has a Search Helper.This allows for easy searching. On the
                                             top right of the page a filter button can be found where you can select all
                                             sorts of Columns to
                                             see only The Selected data you need.</p>
                    <p class="text-info">You can use the filter function included with the export function to only get
                                         specified data to your <strong>Csv's</strong> and <strong>PDf</strong>
                                         documents!</p>
                    <h4 class="text-info">How do i add new Devices/Assets?</h4>
                    <p class="text-gray-700">All Computers should be added to assets as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous!</strong> At the
                                             Top of the screen you will find a button which takes you to
                                             adding a new asset.<a class="text-warning"
                                                                   href="{{route("assets.create")}}"> Stuck? Click here
                                                                                                      to add a new
                                                                                                      Asset</a></p>
                    <h4 class="text-info">Guide to adding new Assets:</h4>
                    <ol>
                        <li>Firstly, Does Your asset have a name? if so fill this in in the first box.</li>
                        <li>Secondly, Fill out your order number for the Device purchased.</li>
                        <li>Thirdly,When Adding the Asset to the system you will need a <strong>Unique</strong> asset
                            tag number which is <strong>not</strong> already in the system.
                        </li>
                        <li>Fourth,Please select when the device where purchased.</li>
                        <li>Fifth,You will need to a serial number corresponding to the device your adding.</li>
                        <li>Sixth,a purchase cost will be needed <strong class="text-info">(No need to enter a '£' sign
                                                                                           this will be done
                                                                                           automatically)</strong></li>
                        <li>Seventh,Which school is this located to ? Assign this here on the dropdown menu.</li>
                        <li>Eighth,Who is the supplier of this asset? fill this in here in the select menu.</li>
                        <li>Ninth,Does this need a check up in a few month's? Place a date in the box.<strong
                                class="text-info">(You will be reminded when this device need's Auditing!)</strong></li>
                        <li>Tenth,select a date for how long of a warranty you have left on this device!</li>
                        <li>Eleventh,Is This a specific type of Device E.g<strong class="text-info">(HP ProDesk
                                                                                                    ,Optiplex 9020
                                                                                                    ,EliteDesktop 800
                                                                                                    G2)</strong></li>
                        <li>Finally,Click <strong>save</strong> in the top Right corner and see if this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to import Assets:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This proccess takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <strong class="text-info">
                            Generated
                            Reports.</strong>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>
                </div>
            </div>
            {{--     heading three end       --}}
            {{--     headingFour       --}}
            <div id="headingFour" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseFourStatus" aria-expanded="false" aria-controls="collapseFour">

                    Status

                </button>

            </div>
            <div id="collapseFourStatus" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordion">
                <div class="card-body">
                    <h4 class="text-info mt-3">What are status'?</h4>
                    <p class="text-gray-700">Creating and assigning assets allow the User to know weather or not a item
                                             is <strong class="text-success">deployable</strong> or at its <strong
                            class="text-warning">EOL(End
                                                 of Life)</strong> or <strong class="text-danger">Broken and in for
                                                                                                  repair.</strong></p>
                    <h4 class="text-info mt-3">How do i assign new status'?</h4>
                    <ol>
                        <li class="text-gray-700">Within your settings tab locate the <strong class="text-info">'status
                                                                                                                Fields'</strong>
                                                  Area or click <a href="{{route("status.index")}}">here</a></li>
                        <li class="text-gray-700">Secondly, Find the 'Add new Status' button in the <strong
                                class="text-info">top right</strong><a
                                class="m-1 d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                    class="fas fa-plus fa-sm text-white-50"></i> Add New Status</a></li>
                        <li class="text-gray-700">Follow the steps within the Open window and proceed to click <strong
                                class="text-success">save</strong></li>
                        <li class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                             viewed</strong> With the
                                                  Drop out selector on the right have side!
                        </li>
                        <li class="text-info">This status can now be found accessibly to set to all items</li>
                    </ol>
                    <p class="text-danger font-weight-bold">Warning, deleting a status un-assign's all related
                                                            items!</p>

                </div>
            </div>
            {{--     headingFour end       --}}
            {{--     headingFive       --}}
            <div id="headingFive" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse" data-bs-target="#collapseFive"
                        aria-expanded="false" aria-controls="collapseFive">
                    <a class="slide" href="#collapseFiveLocations">
                        Locations
                    </a>
                </button>

            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordion">
                <div class="card-body">
                    <h4 class="text-info mt-3">What are locations?</h4>
                    <p class="text-gray-700">Locations are All of the school's within the Trust at the current date!
                                             This allows for you to keep track of where all the items are kept. Click <a
                            href="{{route("location.index")}}">here</a> to navigate to locations </p>
                    <h4 class="text-info mt-3">How do i find and Manage Locations?</h4>
                    <ul>
                        <li class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                             viewed</strong> With the
                                                  Drop out selector on the right have side!
                        </li>
                        <li class="text-gray-700">Finding the <strong class="text-info">Locations</strong> tab will take
                                                  you to all the current schools within Apollo.
                        </li>
                        <li class="text-gray-700">The <strong class="text-info">Attribute</strong> boxes display the
                                                  amount of each items are assigned to each location?
                        </li>
                    </ul>
                    <h4 class="text-info mt-3">Creating , updating and edit locations...</h4>
                    <p class="text-info font-weight-bold"> All these settings can be changed through the 3 dot menu in
                                                           the top of each location modal.</p>
                    <ul>
                        <li class="text-gray-700">Finding the <strong class="text-info">Locations</strong> tab will take
                                                  you to all the current schools within Apollo.
                        </li>
                        <li class="text-gray-700">The <strong class="text-info">Attribute</strong> boxes display the
                                                  amount of each items are assigned to each location?
                        </li>
                        <li class="text-gray-700">Updating Locations can be carried out through the <strong>Pop
                                                                                                            up</strong>
                                                  menu Then clicking <strong>Edit</strong> Then Follow in instructions
                                                  on the
                                                  page and change any inputs which details need updating then just click
                                                  save in the <strong class="text-info">top right.</strong></li>
                        <li class="text-gray-700">Want to <strong class="text-danger">Delete</strong> a Location? You
                                                  will be <strong class="text-warning">warned</strong> before this
                                                  process is confirmed ,Then
                                                  click delete permanently<strong class="text-danger">(This will
                                                                                                      un-assign all
                                                                                                      items)</strong>.
                        </li>
                    </ul>

                </div>
            </div>
            {{--     headingFive end       --}}
            {{--     headingSix       --}}
            <div id="headingSix" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseSixRecycleBin" aria-expanded="false" aria-controls="collapseSix">
                    Recycle Bin
                </button>

            </div>
            <div id="collapseSixRecycleBin" class="collapse" aria-labelledby="headingSix" data-bs-parent="#accordion">
                <div class="card-body">
                    <h4 class="text-info mt-3">What are recycle Bins?</h4>
                    <p class="text-gray-700">Recycle bins allow you to carefully delete certain items in the database
                                             but give you a <strong class="text-info">backup restore</strong> option
                                             increase you
                                             accidentally delete something <small><strong class="text-gray-200">(It
                                                                                                                happens
                                                                                                                to all
                                                                                                                of
                                                                                                                us..)</strong></small>
                    </p>

                    <h4 class="text-info mt-3">Why Do i need to use this?</h4>
                    <p class="text-gray-700">This Element is there in case of accidental deletion as a Back up. Below is
                                             an example button which will be displayed on pages that have this
                                             feature!</p>
                    <a class="d-none d-sm-inline-block btn btn-sm btn-blue shadow-sm"><i
                            class="fas fa-trash-alt fa-sm text-white-50"></i> Recycle Bin</a>
                </div>
            </div>
            {{--     headingSix end       --}}
            {{--     headingSeven       --}}
            <div id="headingSeven" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseSevenImport" aria-expanded="false" aria-controls="collapseSeven">
                    Import
                </button>

            </div>
            <div id="collapseSevenImport" class="collapse" aria-labelledby="headingSeven" data-bs-parent="#accordion">
                <div class="card-body">
                    <h4 class="text-info mt-3">How to import:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                </div>
            </div>
            {{--     headingSeven end       --}}
            {{--     headingEight       --}}
            <div id="headingEight" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseEightAccessory" aria-expanded="false" aria-controls="collapseEight">
                    Accessory
                </button>
            </div>
            <div id="collapseEightAccessory" class="collapse" aria-labelledby="headingEight"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Devices?</h2>
                    <p class="text-gray-700">Accessories can be located within the left hand side menu Labeled
                                             'Accessories' Can't
                                             find it? Click<a href="{{route("accessories.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the tables!</p>
                    <h4 class="text-info">I need to find all the devices at my current School How can i do this?</h4>
                    <p class="text-gray-700">Our Asset Area has a Search Helper.This allows for easy searching.</p>
                    <h4 class="text-info">How do i add new Devices/Accessories?</h4>
                    <p class="text-gray-700">All <strong class="text-info">(Keyboards,mice,Monitors etc)</strong> should
                                             be added to Accessories as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous!</strong> At the
                                             Top of the screen you will find a button which takes you to
                                             adding a new accessory.<a class="text-warning"
                                                                       href="{{route("accessories.create")}}"> Stuck?
                                                                                                               Click
                                                                                                               here
                                                                                                               to add a
                                                                                                               new
                                                                                                               accessory</a>
                    </p>
                    <h4 class="text-info">Guide to adding new Accessories:</h4>
                    <ol>
                        <li>Firstly, Does Your accessory have a name? if so fill this in in the first box.<strong
                                class="text-warning">(This is required)</strong> When Adding the accessory to the system
                            you will need a <strong>Unique</strong> name number which is <strong>not</strong> already in
                            the system.
                        </li>
                        <li>Secondly, Fill out your order number for the Device purchased.</li>
                        <li>Thirdly,Please select when the device was purchased.</li>
                        <li>Fourth,You will need to a serial number corresponding to the device your adding.</li>
                        <li>Fifth,a purchase cost will be needed <strong class="text-info">(No need to enter a '£' sign
                                                                                           this will be done
                                                                                           automatically)</strong></li>
                        <li>Sixth,Which school is this located to ? Assign this here on the dropdown menu.</li>
                        <li>Seventh,Who is the supplier of this accessory? fill this in here in the select menu.</li>
                        <li>Eighth,select a date for how long of a warranty you have left on this device!<strong
                                class="text-info">(This is on the right hand side)</strong></li>
                        <li>Ninth, Who Manufactured the item? If this is known select this field from the <strong
                                class="text-info">stored manufacturers</strong></li>
                        <li>Tenth, Select your category which ever this falls into.</li>
                        <li>Eleventh, Images can be chosen for a reference point to help understand the item you can
                            upload and assign images by clicking the box in the <strong>top right</strong></li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to import Accessories:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This process takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <a class="text-info"
                                                                                              href="{{route("reports.index")}}">
                            Generated
                            Reports.</a>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>
                </div>
            </div>
            {{--     headingEight end       --}}
            {{--     headingNine       --}}
            <div id="headingNine" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseNineComponent" aria-expanded="false" aria-controls="collapseNine">
                    Component
                </button>
            </div>
            <div id="collapseNineComponent" class="collapse" aria-labelledby="headingNine" data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Devices?</h2>
                    <p class="text-gray-700">Components can be located within the left hand side menu Labeled
                                             'Components' Can't
                                             find it? Click<a href="{{route("components.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the tables!</p>
                    <h4 class="text-info">I need to find all the devices at my current School How can i do this?</h4>
                    <p class="text-gray-700">Our Asset Area has a Search Helper.This allows for easy searching.</p>
                    <h4 class="text-info">How do i add new Devices/Components?</h4>
                    <p class="text-gray-700">All <strong class="text-info">(Keyboards,mice,Monitors etc)</strong> should
                                             be added to Components as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous!</strong> At the
                                             Top of the screen you will find a button which takes you to
                                             adding a new Component.<a class="text-warning"
                                                                       href="{{route("components.create")}}"> Stuck?
                                                                                                              Click here
                                                                                                              to add a
                                                                                                              new
                                                                                                              Component</a>
                    </p>
                    <h4 class="text-info">Guide to adding new Components:</h4>
                    <ol>
                        <li>Firstly, Does Your Component have a name? if so fill this in in the first box.<strong
                                class="text-warning">(This is required)</strong> When Adding the Component to the system
                            you will need a <strong>Unique</strong> name number which is <strong>not</strong> already in
                            the system.
                        </li>
                        <li>Secondly, Fill out your order number for the Device purchased.</li>
                        <li>Thirdly,Please select when the device was purchased.</li>
                        <li>Fourth,You will need to a serial number corresponding to the device your adding.</li>
                        <li>Fifth,a purchase cost will be needed <strong class="text-info">(No need to enter a '£' sign
                                                                                           this will be done
                                                                                           automatically)</strong></li>
                        <li>Sixth,Which school is this located to ? Assign this here on the dropdown menu.</li>
                        <li>Seventh,Who is the supplier of this Component? fill this in here in the select menu.</li>
                        <li>Eighth,select a date for how long of a warranty you have left on this device!<strong
                                class="text-info">(This is on the right hand side)</strong></li>
                        <li>Ninth, Who Manufactured the item? If this is known select this field from the <strong
                                class="text-info">stored manufacturers</strong></li>
                        <li>Tenth, Select your category which ever this falls into.</li>
                        <li>Eleventh, Images can be chosen for a reference point to help understand the item you can
                            upload and assign images by clicking the box in the <strong>top right</strong></li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to import Components:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This process takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <a class="text-info"
                                                                                              href="{{route("reports.index")}}">
                            Generated
                            Reports.</a>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>

                </div>
            </div>
            {{--     headingNine end       --}}
            {{--     headingTen       --}}
            <div id="headingTen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseTenMiscellaneous" aria-expanded="false" aria-controls="collapseTen">
                    Miscellaneous
                </button>
            </div>
            <div id="collapseTenMiscellaneous" class="collapse" aria-labelledby="headingTen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Devices?</h2>
                    <p class="text-gray-700">Miscellaneous can be located within the left hand side menu Labeled
                                             'Miscellaneous' Can't
                                             find it? Click<a href="{{route("miscellaneous.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the tables!</p>
                    <h4 class="text-info">I need to find all the devices at my current School How can i do this?</h4>
                    <p class="text-gray-700">Our Asset Area has a Search Helper.This allows for easy searching.</p>
                    <h4 class="text-info">How do i add new Devices/Miscellaneous?</h4>
                    <p class="text-gray-700">All <strong class="text-info">(Keyboards,mice,Monitors etc)</strong> should
                                             be added to Miscellaneous as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous!</strong> At the
                                             Top of the screen you will find a button which takes you to
                                             adding a new Miscellanea.<a class="text-warning"
                                                                         href="{{route("miscellaneous.create")}}">
                            Stuck? Click here
                            to add a new Miscellanea</a></p>
                    <h4 class="text-info">Guide to adding new Miscellaneous:</h4>
                    <ol>
                        <li>Firstly, Does Your Miscellanea have a name? if so fill this in in the first box.<strong
                                class="text-warning">(This is required)</strong> When Adding the Miscellanea to the
                            system you will need a <strong>Unique</strong> name number which is <strong>not</strong>
                            already in the system.
                        </li>
                        <li>Secondly, Fill out your order number for the Device purchased.</li>
                        <li>Thirdly,Please select when the device was purchased.</li>
                        <li>Fourth,You will need to a serial number corresponding to the device your adding.</li>
                        <li>Fifth,a purchase cost will be needed <strong class="text-info">(No need to enter a '£' sign
                                                                                           this will be done
                                                                                           automatically)</strong></li>
                        <li>Sixth,Which school is this located to ? Assign this here on the dropdown menu.</li>
                        <li>Seventh,Who is the supplier of this Miscellanea? fill this in here in the select menu.</li>
                        <li>Eighth,select a date for how long of a warranty you have left on this device!<strong
                                class="text-info">(This is on the right hand side)</strong></li>
                        <li>Ninth, Who Manufactured the item? If this is known select this field from the <strong
                                class="text-info">stored manufacturers</strong></li>
                        <li>Tenth, Select your category which ever this falls into.</li>
                        <li>Eleventh, Images can be chosen for a reference point to help understand the item you can
                            upload and assign images by clicking the box in the <strong>top right</strong></li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to import Miscellaneous:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This process takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <a class="text-info"
                                                                                              href="{{route("reports.index")}}">
                            Generated
                            Reports.</a>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>
                </div>
            </div>
            {{--     headingTen end       --}}
            {{--     headingTwenty       --}}
            <div id="headingTwenty" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwentyConsumables" aria-expanded="false"
                        aria-controls="collapseTwenty">
                    Consumables
                </button>
            </div>
            <div id="collapseTwentyConsumables" class="collapse" aria-labelledby="headingTwenty"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Devices?</h2>
                    <p class="text-gray-700">Consumables can be located within the left hand side menu Labeled
                                             'Consumables' Can't
                                             find it? Click<a href="{{route("consumables.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the tables!</p>
                    <h4 class="text-info">I need to find all the devices at my current School How can i do this?</h4>
                    <p class="text-gray-700">Our Asset Area has a Search Helper.This allows for easy searching.</p>
                    <h4 class="text-info">How do i add new Devices/Consumables?</h4>
                    <p class="text-gray-700">All <strong class="text-info">(Keyboards,mice,Monitors etc)</strong> should
                                             be added to Consumables as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Consumables!</strong> At the Top
                                             of the screen you will find a button which takes you to
                                             adding a new Consumable.<a class="text-warning"
                                                                        href="{{route("consumables.create")}}"> Stuck?
                                                                                                                Click
                                                                                                                here
                                                                                                                to add a
                                                                                                                new
                                                                                                                Consumable</a>
                    </p>
                    <h4 class="text-info">Guide to adding new Consumables:</h4>
                    <ol>
                        <li>Firstly, Does Your Consumable have a name? if so fill this in in the first box.<strong
                                class="text-warning">(This is required)</strong> When Adding the Consumable to the
                            system you will need a <strong>Unique</strong> name number which is <strong>not</strong>
                            already in the system.
                        </li>
                        <li>Secondly, Fill out your order number for the Device purchased.</li>
                        <li>Thirdly,Please select when the device was purchased.</li>
                        <li>Fourth,You will need to a serial number corresponding to the device your adding.</li>
                        <li>Fifth,a purchase cost will be needed <strong class="text-info">(No need to enter a '£' sign
                                                                                           this will be done
                                                                                           automatically)</strong></li>
                        <li>Sixth,Which school is this located to ? Assign this here on the dropdown menu.</li>
                        <li>Seventh,Who is the supplier of this Consumable? fill this in here in the select menu.</li>
                        <li>Eighth,select a date for how long of a warranty you have left on this device!<strong
                                class="text-info">(This is on the right hand side)</strong></li>
                        <li>Ninth, Who Manufactured the item? If this is known select this field from the <strong
                                class="text-info">stored manufacturers</strong></li>
                        <li>Tenth, Select your category which ever this falls into.</li>
                        <li>Eleventh, Images can be chosen for a reference point to help understand the item you can
                            upload and assign images by clicking the box in the <strong>top right</strong></li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to import Consumables:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This process takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <a class="text-info"
                                                                                              href="{{route("reports.index")}}">
                            Generated
                            Reports.</a>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>
                </div>
            </div>
            {{--     headingTwenty end       --}}
            {{--     headingEleven       --}}
            <div id="headingEleven" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseElevenUsers" aria-expanded="false" aria-controls="collapseEleven">
                    Users
                </button>
            </div>
            <div id="collapseElevenUsers" class="collapse" aria-labelledby="headingEleven" data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i Edit my User Details?</h2>
                    <p class="text-gray-700">User Details can be changed from the <strong
                            class="text-info">Profile</strong> display menu for your own profile Only Click <a
                            href="{{route("user.details")}}">here </a>to access this area or navigate to the <strong>top
                                                                                                                     right
                                                                                                                     menu.</strong> </br>
                        <strong class="text-info">(Unless you are a super admin or admin
                                                  of a School area you can edit all users details)</strong></p>
                    <h4 class="text-info mt-3">I am a Full admin how i reset a users password for them?</h4>
                    <p class="text-gray-700">If you already have permissions , Please Direct all users with lost
                                             passwords to <a href="{{route("forgot.my.password")}}">here</a> <strong
                            class="text-warning">All
                                                 they need is there email</strong></p>
                    <p class="text-gray-700">Else Use the <strong class="text-info">365 Office</strong> log-in On the
                                             Homepage and use your <strong class="text-info">CLPT</strong> Account!</p>
                    <h4 class="text-info">I've Lost my Password What can i do?</h4>
                    <p class="text-gray-700">If You have Forgot your password you can click <a
                            href="{{route("forgot.my.password")}}" class="text-capitalize">here</a> to reset your
                                             password by your email! else please contact your Admin and they will reset
                                             this for you!</p>
                    <h4 class="text-info mt-2">I know my password How can i reset this?</h4>
                    <p class="text-gray-700">If you know your password you can navigate through the profile link in the
                                             top right or Click <a href="{{route("user.details")}}"
                                                                   class="text-capitalize">here</a>.</p>
                    <h4 class="text-info">Steps to reset:</h4>
                    <ol>
                        <li>Find Out your password from your original sign up email.</li>
                        <li>Navigate to the link above and click reset password</li>
                        <li>Input your current password to the top box</li>
                        <li>Think of a new password and match this in both Boxes <strong class="text-danger">(Capitals
                                                                                                             are
                                                                                                             included!)</strong>
                        </li>
                    </ol>

                </div>
            </div>
            {{--     headingEleven end       --}}
            {{--     headingTwelve       --}}
            <div id="headingTwelve" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwelvePermissions" aria-expanded="false"
                        aria-controls="collapseTwelve">
                    Permissions
                </button>
            </div>
            <div id="collapseTwelvePermissions" class="collapse" aria-labelledby="headingTwelve"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">I Can't see all the schools in my organisation what's wrong?</h2>
                    <ul>
                        <li class="text-gray-700">All Users have a user role and locations there are allowed to see, If
                                                  you can see another school you <strong class="text-danger">May
                                                                                                             Not</strong>
                                                  have access.
                        </li>
                        <li class="text-gray-700">If you think you should have access please contact your <strong
                                class="text-info">local technician</strong> admin for more information or Email <strong>Apollo@clpt.co.uk</strong>
                        </li>
                    </ul>
                    <h4 class="text-info">Im getting a Permissions 401 page why?</h4>
                    <p class="text-gray-700">This Means you <strong class="text-danger">do not</strong> have access to
                                             this information, please contact your <strong class="text-info">local
                                                                                                             technician</strong>
                                             admin
                                             for more information or Email <strong>Apollo@clpt.co.uk</strong></p>
                    <h4 class="text-info">Im an Admin how can i assign permissions?</h4>
                    <ol>
                        <li class="text-gray-700">Navigate to the Users>permissions tab on the left hand side and select
                                                  a user you would like to add locations to Or click <a
                                href="{{route("users.index")}}"></a>here
                        </li>
                        <li class="text-gray-700">Find your Designated users and select <strong
                                class="text-info">Edit</strong> on the drop down menu
                        </li>
                        <li class="text-gray-700">Locate the <strong class="text-info">Permissions</strong> box at the
                            <strong class="text-info">bottom</strong> of the page and select all the schools you would
                                                  like adding to this users profile.
                        </li>
                        <li class="text-info">Any Admins roles can also be assigned here too!</li>
                    </ol>
                </div>
            </div>
            {{--     headingTwelve end       --}}
            {{--     headingThirteen       --}}
            <div id="headingThirteen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseThirteenManufacturers" aria-expanded="false"
                        aria-controls="collapseThirteen">
                    Manufacturers
                </button>
            </div>
            <div id="collapseThirteenManufacturers" class="collapse" aria-labelledby="headingThirteen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Manufacturers?</h2>
                    <p class="text-gray-700">Manufacturers can be located within the left hand side menu Labeled
                                             'Manufacturers' Can't
                                             find it? Click<a href="{{route("manufacturers.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the blocks!</p>
                    <h4 class="text-info">How do i add new Manufacturer?</h4>
                    <p class="text-gray-700">All <strong class="text-info">Manufacturers</strong> should be added to
                                             Manufacturers as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous.</strong><a
                            class="text-warning" href="{{route("miscellaneous.create")}}">
                            Stuck? Click here
                            to add a new Miscellanea.</a></p>
                    <h4 class="text-info">Guide to adding new Manufacturers:</h4>
                    <ol>
                        <li>Firstly, Does Your Manufacturer have a name? if so fill this in in the first box.<strong
                                class="text-warning">(This is required)</strong> When Adding the Manufacturer to the
                            system you will need a <strong>Unique</strong> name number which is <strong>not</strong>
                            already in the system.
                        </li>
                        <li>Secondly, Fill out your Telephone Number for the Manufacturer.</li>
                        <li>Thirdly,Please Enter a <strong class="text-info">website</strong> for the <strong
                                class="text-info">Manufacturer</strong> you have named.
                        </li>
                        <li>Fourth,Please Enter a <strong class="text-info">Email Address</strong> for the <strong
                                class="text-info">Manufacturer</strong> you have named for Support purposes.
                        </li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <p class="text-gray-700 text-info">A Picture can be added in the top right if you would like nay
                                                       visual aid!</p>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to import Manufacturers:</h4>
                    <p class="text-info">A Few quick Notes before we begin ,</p>
                    <ul class="">
                        <li class="text-danger">There is a template provided which needs to be used No other templates
                                                can be used!
                        </li>
                        <li class="text-danger">Always remember to upload a file before clicking import!</li>
                        <li class="text-danger">Once you have added all your data to the excel spreadsheet Try uploading
                                                this! This input only accepts<strong>.Csv</strong> files.
                        </li>
                        <li class="text-danger">Errors can always occur when uploading files This is why any rows which
                                                has no issues will be pushed through and added for you. Your next option
                                                after this is to
                                                1.export all the errors back to <strong>.Csv </strong>and then correct
                                                the current issues
                                                and Re-Upload your new file. </br> 2.Once your <strong>.Csv</strong>
                                                file has been uploaded
                                                there is a friendly user interface which allows you to manually edit all
                                                the rows which are
                                                incorrect with tool tips to help you across the way!
                        </li>
                    </ul>
                    <ol>
                        <li>Firstly, Download the specified template, this can be found once you click import the button
                            then the <strong class="text-info">'Download import template'</strong></li>
                        <li>Secondly, Fill in all the data in the correct columns for your Csv file and <strong
                                class="text-info">save</strong> this file!
                        </li>
                        <li>Thirdly, Click the import button like before but this time click<strong class="text-info">
                                browse </strong> on the blue box and select your <strong class="text-info">new</strong>
                            Csv file.
                        </li>
                        <li>Fourth, Click <strong class="text-info">import</strong> in the bottom right corner and let
                            the system process your file.
                        </li>
                        <li>Fifth,If you don't have any errors this will return with a <strong class="text-success">success
                                                                                                                    message</strong>
                            which tell you all of your data fields were added. Else, Your will be
                            moved to a new page with the <strong class="text-danger">incorrect </strong> fields which
                            have errors to change your errors. Click <strong class="text-info">save</strong> or <strong
                                class="text-info">export</strong> all of your errors to CSv and Re-Uploaded this after
                            you have fixed your changes.
                        </li>
                        <li>Sixth,If this has all complete correctly you will be returned once again with a <strong
                                class="text-success">success message</strong> that your Items have been added!
                        </li>
                    </ol>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This process takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <a class="text-info"
                                                                                              href="{{route("reports.index")}}">
                            Generated
                            Reports.</a>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>

                </div>
            </div>
            {{--     headingThirteen end       --}}
            {{--     headingFourteen       --}}
            <div id="headingFourteen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseFourteenSuppliers" aria-expanded="false"
                        aria-controls="collapseFourteen">

                    Suppliers

                </button>
            </div>
            <div id="collapseFourteenSuppliers" class="collapse" aria-labelledby="headingFourteen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Suppliers?</h2>
                    <p class="text-gray-700">Suppliers can be located within the left hand side menu Labeled 'Suppliers'
                                             Can't
                                             find it? Click<a href="{{route("suppliers.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the blocks!</p>
                    <h4 class="text-info">How do i add new Supplier?</h4>
                    <p class="text-gray-700">All <strong class="text-info">Suppliers</strong> should be added to
                                             Suppliers as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous.</strong><a
                            class="text-warning" href="{{route("miscellaneous.create")}}">
                            Stuck? Click here
                            to add a new Miscellanea.</a></p>
                    <h4 class="text-info">Guide to adding new Suppliers:</h4>
                    <ol>
                        <li>Firstly, Does Your Supplier have a name? if so fill this in in the first box.<strong
                                class="text-warning">(This is required)</strong> When Adding the Supplier to the system
                            you will need a <strong>Unique</strong> name number which is <strong>not</strong> already in
                            the system.
                        </li>
                        <li>Secondly, Fill out your Street Address for the Supplier.</li>
                        <li>Thirdly,Please Enter a <strong class="text-info">Secondary address</strong> for the <strong
                                class="text-info">Supplier</strong> you have named <strong class="text-danger">Only if
                                                                                                               necessary</strong>.
                        </li>
                        <li>Fourth,Please Enter a <strong class="text-info">City, County, Postcode</strong> for the
                            <strong class="text-info">Supplier</strong> you have named.
                        </li>
                        <li>Fifth,If needed Enter any <strong class="text-info">Notes</strong> for the <strong
                                class="text-info">Supplier</strong> you have named.
                        </li>
                        <li>Sixth, Some contact detail will needed to be filled in on the right hand side like <strong>(Website
                                                                                                                       Url
                                                                                                                       ,
                                                                                                                       Telephone
                                                                                                                       ,Fax
                                                                                                                       and
                                                                                                                       Email
                                                                                                                       address)</strong>
                        </li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below!
                        </li>
                    </ol>
                    <p class="text-gray-700 text-info">A Picture can be added in the top right if you would like nay
                                                       visual aid!</p>
                    <div class="d-sm-flex align-items-center ">
                        <div class="text-gray-700">Example Errors Box:</div>
                        <div class="alert alert-danger m-5 d-inline">red box</div>
                    </div>
                    <h4 class="text-info mt-3">How to Generate a live report:</h4>
                    <p class="text-gray-700">You are able to Create a <strong>Pdf report</strong> file based on the data
                                             of
                                             the page you are currently accessing.This process takes sometime to
                                             generate so once you have
                                             clicked the button like 'below' Please navigate to the link in the green
                                             box or follow settings
                                             in your navigation and <strong>click</strong> <a class="text-info"
                                                                                              href="{{route("reports.index")}}">
                            Generated
                            Reports.</a>

                        <a class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-dark-50"></i> Generate Report</a>
                    </p>
                </div>
            </div>
            {{--     headingFourteen end       --}}
            {{--     headingFithteen       --}}
            <div id="headingFithteen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseFithteenAssetModels" aria-expanded="false"
                        aria-controls="collapseFithteen">
                    Asset Models
                </button>
            </div>
            <div id="collapseFithteenAssetModels" class="collapse" aria-labelledby="headingFithteen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Models of devices?</h2>
                    <p class="text-gray-700">Consumables can be located within the left hand side menu Labeled
                                             'Consumables' Can't
                                             find it? Click<a href="{{route("asset-models.index")}}"
                                                              class="text-capitalize"> here</a></p>
                    <p class="text-gray-700">All Items can be <strong class="text-info">edited , Deleted and
                                                                                        viewed</strong> With the Drop
                                             out selector on the right have side of the tables!</p>
                    <h4 class="text-info">I need to find your specific model?</h4>
                    <p class="text-gray-700">Our Asset Model Area has a Search Helper.This allows for easy
                                             searching.</p>
                    <h2 class="text-info">I want to Add a new Device we have in stock. How?</h2>
                    <p class="text-gray-700">Our Asset Model Area has a Search Helper.This allows for easy
                                             searching.</p>
                    <p class="text-gray-700">All <strong class="text-info">New Devices To be registered</strong> should
                                             be added to Assets Models as all other Products have there
                                             related columns <strong class="text-info">Not sure where to Put an
                                                                                       un-related Item Use
                                                                                       Miscellaneous!</strong> At the
                                             Top of the screen you will find a button which takes you to
                                             adding a new Asset Model.<a class="text-warning"
                                                                         href="{{route("asset-models.create")}}"> Stuck?
                                                                                                                  Click
                                                                                                                  here
                                                                                                                  to add
                                                                                                                  a new
                                                                                                                  Asset
                                                                                                                  Mode</a>
                    </p>
                    <h4 class="text-info">Guide to adding new Asset Models to assign to your Items:</h4>
                    <ol>
                        <li>Firstly,Fill in your name field with the name of you new device <strong class="text-info">(Eg.Hp-ProDesk)</strong>
                            you will need a <strong>Unique</strong> name which is <strong>not</strong> already in the
                            system.
                        </li>
                        <li>Secondly, Select a <strong class="text-info">manufacturer</strong> from the select list
                            Which relates to your item name.
                        </li>
                        <li>Thirdly,Please Enter a <strong class="text-info">Model Number</strong>.</li>
                        <li>Fourth, The deprecation column allows you to select how quick this model will loose its
                            value. so if an Ipad looses it value 2 times quicker than a Laptop this is where you would
                            select this.<strong class="text-danger">If nothing is shown you need to add a depreciation
                                                                    models first click <a
                                    href="{{route("depreciation.index")}}">here</a></strong></li>
                        <li>Fifth,How long Will this Item be usable for? Select a time in <strong>Months</strong> Of
                            when the Item will no longer be any use to the organisation!
                        </li>
                        <li>Sixth, Fieldset's allow for you to customize your Asset Model.Firstly you will need to
                            create a fieldset <a href="{{route("fieldsets.create")}}">here</a> Creating a specific
                            fieldset allows you to Customize <strong class="text-info">internal components</strong> such
                            as <strong class="text-info">Ram , CPU etc</strong> This allows for you to know more
                            specifically what internal are in each Device!
                        </li>
                        <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if
                            this all saves
                            correctly. If you have any errors this will be displayed in a red box at the top ,like the
                            screen like below! You can <strong class="text-info">now</strong> assign this new created
                            asset Model to any Asset.
                        </li>
                    </ol>

                </div>
            </div>
            {{--     headingFithteen end       --}}
            {{--     headingSixteen       --}}
            <div id="headingSixteen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseSixteenDepreciation" aria-expanded="false"
                        aria-controls="collapseSixteen">
                    Depreciation
                </button>
            </div>
            <div id="collapseSixteenDepreciation" class="collapse" aria-labelledby="headingSixteen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Depreciation Models?</h2>
                    <p class="text-gray-700">Depreciation Models can be located within the left hand side menu Labeled
                                             'Depreciation' Under <strong class="text-info">Settings</strong> Can't
                                             find it? Click<a href="{{route("depreciation.index")}}"
                                                              class="text-capitalize"> here</a></p>
                </div>
                <h4 class="text-info">Why do i need to create a new Depreciation Model?</h4>
                <p class="text-gray-700">Depreciation Models May want to be created so if your assets go <strong
                        class="text-danger">down</strong> in value after <strong class="text-warning">(Eg.36
                                                                                                      Months)</strong>
                                         and now <strong class="text-success">hold</strong> there value this can be
                                         dynamic and changed for the whole application through this tab! </br><strong
                        class="text-info">Edited
                                          , Deleted and viewed</strong> With the Drop out selector on the right have
                                         side of the tables! </p>

            </div>
            {{--     headingSixteen end       --}}
            {{--     headingSeventeen       --}}
            <div id="headingSeventeen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeventeenCategories" aria-expanded="false"
                        aria-controls="collapseSeventeen">
                    Categories
                </button>
            </div>
            <div id="collapseSeventeenCategories" class="collapse" aria-labelledby="headingSeventeen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Categories?</h2>
                    <p class="text-gray-700">Categories can be located within the left hand side menu Labeled
                                             'Depreciation' Under <strong class="text-info">Settings</strong> Can't
                                             find it? Click<a href="{{route("category.index")}}"
                                                              class="text-capitalize"> here</a></p>
                </div>
                <h4 class="text-info">Why do i need to create a category?</h4>
                <p class="text-gray-700"><strong>Categories</strong> allow you to create sections to assign new Items to
                                                                     like for example <strong class="text-info">(Student's,
                                                                                                                Staff,
                                                                                                                Business
                                                                                                                etc)</strong>.
                                                                     So when
                                                                     looking at an asset you can know who this belongs
                                                                     too!</p>

            </div>
            {{--     headingSeventeen end       --}}
            {{--     headingEighteen       --}}
            <div id="headingEighteen" class="slide">
                <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                        data-bs-target="#collapseEighteenFieldsets" aria-expanded="false"
                        aria-controls="collapseEighteen">
                    Fieldsets
                </button>
            </div>
            <div id="collapseEighteenFieldsets" class="collapse" aria-labelledby="headingEighteen"
                 data-bs-parent="#accordion">
                <div class="card-body">
                    <h2 class="text-info">Where can i find All of my Sets of internal components?</h2>
                    <p class="text-gray-700">These are known as Fieldset's.These can be located within the left hand
                                             side menu Labeled 'Depreciation' Under <strong
                            class="text-info">Settings</strong> Can't
                                             find it? Click<a href="{{route("fieldsets.index")}}"
                                                              class="text-capitalize"> here</a></p>
                </div>
                <h4 class="text-info">Why do i need to create a Fieldset's?</h4>
                <p class="text-gray-700"><strong>FieldSet's</strong> allow you to create Section to assign new Items to
                                                                     like for example <strong class="text-info">(Laptops,
                                                                                                                ipads,
                                                                                                                smartboards
                                                                                                                etc)</strong>.
                                                                     So when
                                                                     looking at an asset you can know What internal it
                                                                     has without tearing it apart!</p>
                <h4 class="text-info">How do i make new internal components an option? <strong>(Ram, CPU etc)</strong>
                </h4>
                <p class="text-gray-700">You can navigate to <strong class="text-info">Custom Fields</strong> in the
                                         navigation menu or click <a href="/fields">here</a>!</p>
                <p class="text-gray-700">From here Click your <strong class="text-success">Add new Field</strong>
                                         button. </p>
                <ol>
                    <li>Firstly,Fill in your name field with the name of you new device <strong class="text-info">(Eg.Ram)</strong>
                        you will need a <strong>Unique</strong> name which is <strong>not</strong> already in the
                        system.
                    </li>
                    <li>Secondly, Select the input box you would like when selecting this field from the select menu
                        <strong class="text-info"> examples below:</strong>
                    </li>
                    <li class="text-info ">Text: <input type="text" class="ml-5"></li>
                    <li class="text-info ">Select Field: <select class="ml-5">
                            <option>Example Option</option>
                        </select></li>
                    <li class="text-info" style="resize:none;">Multi-Line: <textarea></textarea></li>
                    <li class="text-info">Checkbox: <input type="checkbox"></li>
                    <li>What <strong class="text-info">Data</strong> Form do you require? please select your specific
                        one!
                    </li>
                    <li>If you would like to <strong class="text-success">help</strong> the user while filling out these
                        fields please enter any help text on what data you would want to be filled out!
                    </li>
                    <li>Finally,Click <strong class="text-success">save</strong> in the top Right corner and see if this
                        all saves
                        correctly. If you have any errors this will be displayed in a red box at the top ,like the
                        screen like below! You can <strong class="text-info">now</strong> assign this new created asset
                        Model to any Asset.
                    </li>

                </ol>
            </div>
        </div>
        {{--     headingEighteen end       --}}
        {{--     headingNinteen start      --}}
        <div id="headingNineteen" class="slide">
            <button class="btn btn-link collapsed slide" data-bs-toggle="collapse"
                    data-bs-target="#collapseNineteenRequests" aria-expanded="false" aria-controls="headingNineteen">
                Requests
            </button>
        </div>
        <div id="collapseNineteenRequests" class="collapse" aria-labelledby="headingNineteen"
             data-bs-parent="#accordion">
            <div class="card-body">
                <h2 class="text-info">How Do Requests function?</h2>
                <p class="text-gray-700">Requests allow actions to be queued and allow for approval from a manager
                                         before any changes to a specific item are persisted.</p>
                <h3 class="text-info">Rules applied towards Requests:</h3>
                <ol>
                    <li>If you are a <strong class='text-info'>Manager</strong> or <strong class='text-info'>Global
                                                                                                             Admin</strong>
                        Requests will automatically be approved without any input.
                    </li>
                    <li>If you are a <strong class='text-info'>Technician</strong> or any role below, all
                        Requests will need to be approved. An input from the Manager will be required to approve or deny
                        your request.
                    </li>
                </ol>
                <h3 class="text-info">How do I tell my manager I am waiting for a request to be approved?</h3>
                <p class="text-gray-700">No Need , Email notifications will be sent out to your manager for them to
                                         approve or deny your request.</p>
                <p class="text-gray-700">You can navigate to <strong class="text-info">Requests</strong> in the
                                         navigation menu or click <a href="/requests">here</a>!</p>
            </div>
        </div>
        {{--     headingNinteen end      --}}
    </section>
@endsection

@section('js')
    <script>
        if (location.hash !== null && location.hash !== "") {
            console.log(document.querySelector(location.hash))
            document.querySelector(location.hash).classList.add('show');
        }
    </script>
@endsection
