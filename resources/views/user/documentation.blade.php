
@extends('layout.user')

@section('content')


    <div class="col-md-12 heightminus70px col-xs-12 col-sm-12">
        <div class="col-md-3 paddingzero height100 api_left_menus col-xs-12">
            <p class="api_menu_title colorlightblue">Javascript Plugin</p>
            <ul class="plugin_list">
                <li class="active"><a href="#">Getting Started Guide</a></li>
                <li><a href="#">Code Examples</a></li>
                <li><a href="#">Best Practices</a></li>
                <li><a href="#">Fixing Browser Quirks</a></li>
                <li><a href="#">Advanced Usage</a></li>
                <li><a href="#">Javascript Widget Reference</a></li>
            </ul>
            <p class="api_menu_title colorlightblue">AddressFinder API</p>
            <ul class="plugin_list">
                <li><a href="#">Address AutoComplete</a></li>
                <li><a href="#">Location AutoComplete</a></li>
                <li><a href="#">Address Meta Data</a></li>
                <li><a href="#">Location Meta Data</a></li>
                <li><a href="#">Address Cleanse</a></li>
                <li><a href="#">API Errors</a></li>
            </ul>
            <p class="api_menu_title colorlightblue">Integrations</p>
            <ul class="plugin_list">
                <li><a href="#">WooCommerce</a></li>
                <li><a href="#">BigCommerce</a></li>
                <li><a href="#">SalesForce</a></li>
                <li><a href="#">Ruby</a></li>
                <li><a href="#">iOS</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-9 api_right_content col-xs-12">
            <h2 class="colorgreen">JavaScript Plugin</h2>
            <p class="api_text">Easily embed our JavaScript plugin in your own website for an accurate address and location auto-complete service.</p>
            <ul class="javascript_plugin_list">
                <li><a href="#">Getting Started</a></li>
                <li><a href="#">Best Practices</a></li>
                <li><a href="#">Advanced Usage</a></li>
                <li><a href="#">Code Demos</a></li>
                <li><a href="#">Widget Documentation</a></li>
            </ul>
            <div class="col-md-12 paddingzero">
                <h2 class="colorgreen ">Address APIs</h2>
                <p class="api_text">Use our powerful Address Search APIs to query the data and meta-data of Australia's addresses.</p>
                <p class="api_menu_title colorlightblue">Address Search API</p>
                <p class="api_text">Send an address fragment to this API, and receive back a list of matching addresses. Used by the AddressFinder widget to populate the autocomplete popup window.</p>
                <p class="api_text mart20px">Possible uses of the Address Search API include:</p>
                <ul class="api_list mart20px colorlightblue">
                    <li><span>Windows applications used behind your firewall</span></li>
                    <li><span>Mobile iOS or Android applications</span></li>
                    <li><span>Embed within a Flash app</span></li>
                </ul>
                <p class="api_menu_title colorlightblue">Address Info API</p>
                <p class="api_text">Use the unique identifier returned by the Address Search API, and receive detailed meta data about the selected address.</p>
                <p class="api_text">This include:</p>
                <ul class="api_list mart20px colorlightblue">
                    <li><span>Street name, Suburb. etc</span></li>
                    <li><span>GPS coordinates</span></li>
                    <li><span>The canonical address</span></li>
                </ul>
                <p class="api_menu_title colorlightblue">Address Cleanse API</p>
                <p class="api_text">Send an address to this API and receive back a unique matching addresses. Possible uses of the Address Cleanse API include:</p>
                <ul class="api_list mart20px colorlightblue">
                    <li><span>Cleanup a file of addresses</span></li>
                    <li><span>Validate a single addresses</span></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="receive_location" value=" > API Documentation" />
    <input type="hidden" id="receive_username" value="{{$data['username']}}" />

@endsection